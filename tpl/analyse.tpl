<div class="row">
    <div class="col text-center">
        <h2>{$smarty.const.ETP4}</h2>
    </div>
</div>
<div class="row">
    <div class="col text-center" id="erreur">
    </div>
</div>
<div class="row">
    <div class="col">
           <ul class="list-group"> 
               {foreach $convert_etape as $value}
                   <li class=list-group-item disabled" aria-disabled="true" id="{$value@key}">{$value} <span class="badge badge-secondary visible" id="{$value@key|replace:':':'_'}_a_faire">{$smarty.const.A_FAIRE}</span> <span class="badge badge-success invisible" id="{$value@key|replace:':':'_'}_success">{$smarty.const.SUCCESS}</span></li>
               {/foreach}
           </ul>
    </div>
</div>
<div class="row">
    <div class="col">
           <ul class="list-group"> 
               <li class=list-group-item disabled" aria-disabled="true" id="titre_requete"><strong class="text-center">{$smarty.const.TITRE_REQUETE}</strong></li>
               <li class=list-group-item disabled" aria-disabled="true" id="travail_requete">{$smarty.const.TRAVAIL_REQUETE} : <span id="nb_requete_a_faire"> 0 </span> / <span id="tot_requete"> 0 </span></li>
           </ul>
    </div>
</div>
           <div class="row">
    <div class="col">
        <div >
            <div class="alert alert-primary invisible" role="alert" id="zone_barre"><span id="suivi">{$smarty.const.COURS}</span>
                <div class="demo-wrapper html5-progress-bar">
                    <div class="progress-bar-wrapper">
			<progress id="progressbar" value="0" max="100"></progress>
			<span class="progress-value">0%</span>
                    </div>
                </div>
            </div>
        </div>
        <form method="post" class="m10">
           <input type="hidden" name="op" value="5" />
           <input type="hidden" name="cle" value="{$cle}" id="cle"/>
           <input type="hidden" name="username" value="{$username}" id="username"/>
           <input type="hidden" name="database" value="{$database}" id="database"/>
           <input type="hidden" name="host" value="{$host}" id="host"/>
           <input type="hidden" name="langue" value="{$lang}" id="langue"/>
           <input type="hidden" name="db_collation" value="{$db_collation}" id="db_collation" />
           <button type="button" class="btn btn-success" id="lancer" data-load-text="{$smarty.const.PROCESS}">{$smarty.const.ANALYSE}</button>
           <button type="button" class="btn btn-success invisible" id="conv" data-load-text="{$smarty.const.PROCESS}">{$smarty.const.CONVERSION}</button>
           <button type="submit" class="btn btn-primary invisible" id="suivant">{$smarty.const.CLOSE}</button>
           <p id="zone_barre"></p>
        </form>
    </div>
</div>
           
<script type="text/javascript">
$(document).ready(function() {
    var taches = [ {$tache_js} ];
    $("#lancer").click(function() {
        var btn = $(this); 
        $(btn).buttonLoader('start');
        var n = taches.length;
        for( i=0; i<n; i++){
            var val = {
                "c" : encodeURI($("#cle").val()),
                "a" : encodeURI(taches[i]),
                "u" : encodeURI($("#username").val()),
                "h" : encodeURI($("#host").val()),
                "d" : encodeURI($("#database").val()),
                "l" : encodeURI($("#langue").val()),
                "p" : encodeURI($("#db_collation").val())
            };
            val = $(this).serialize() + "&" + $.param(val);
            $.ajax({
                url: "{$url}/inc/ajax.php",
                type : "post",
                data: val,
                datatype: 'json',
                success: function(data){  
                    var id = '#'+data.status+'_success';
                    var idhide = '#'+data.status+'_a_faire';
                    var message = data.message;
                    progressbar = $('#progressbar');
                    $(idhide).addClass("invisible");
                    $(id).removeClass("invisible");
                    var tot = message.split(' ');
                    $("#tot_requete").html("<strong>" + tot[1] + "</strong>");
                    if ( data.status === 'fin_analyse'){
                        $('#lancer').addClass("invisible");
                        $('#zone_barre').removeClass("invisible");
                        var total = parseInt( tot[1],10);
                        if ( tot[1] == "0"){
                            $('#suivant').removeClass("invisible");
                            $('#zone_barre').removeClass("alert-primary");
                            $('#zone_barre').addClass("alert-success");
                            $('#suivi').text( " {$smarty.const.FINI} ");
                            progressbar.val( "100");
                            $('.progress-value').text( "100" + '%');
                        }else{
                            $('#conv').removeClass("invisible");                       
                        }
                    }
                },
                error:function(){
                    $('#erreur').html('Erreur de mise à jour du champs');
                }
            });  
        } 
    });
    $("#conv").click(function() {
        var btn = $(this); 
        var nb_sql = $("#tot_requete").text();
        var progressbar = $('#progressbar');
        var value_progressbar = progressbar.val();
        $(btn).buttonLoader('start');
        nb_sql = parseInt( nb_sql , 10);
        for ( i=0; i < nb_sql; i++ ){
            var val = {
                "c" : encodeURI($("#cle").val()),
                "a" : encodeURI('conversion_' + i),
                "u" : encodeURI($("#username").val()),
                "h" : encodeURI($("#host").val()),
                "d" : encodeURI($("#database").val()),
                "l" : encodeURI($("#langue").val()),
                "p" : encodeURI($("#db_collation").val())
            };
            val = $(this).serialize() + "&" + $.param(val);
            $.ajax({
                url: "{$url}/inc/ajax.php",
                type : "post",
                data: val,
                datatype: 'json',
                success: function(data){  
                    var message = data.message;
                    var status = data.status;
                    if ( status != "Erreur"){
                        var restant = message.split(' ');
                        var fait = nb_sql - restant[1];
                        console.log( fait );
                        $("#nb_requete_a_faire").text( fait );
                        console.log(restant[1]);
                        if ( restant[1] == 0 ){
                            /* Plus de requete à faire */
                            progressbar.val( "100" );
                            $('.progress-value').text("100" + '%');
                            $('#suivant').removeClass("invisible");
                            $('#zone_barre').removeClass("alert-primary");
                            $('#zone_barre').addClass("alert-success");
                            $('#conv').addClass("invisible");
                            $('#suivi').text( " {$smarty.const.FINI} ");
                        }else{
                            value_progressbar = ( fait * 100 ) / nb_sql;
                            value_progressbar = Math.round( value_progressbar );
                            progressbar.val( value_progressbar );
                            $('.progress-value').text(value_progressbar + '%');
                        }
                    }else{
                        $('#erreur').html('Erreur dans les requetes sql');
                    }
                },
                error:function(){
                    $('#erreur').html('Erreur de mise à jour du champs');
                }
            });
        }
        
    });
});               
</script>
               