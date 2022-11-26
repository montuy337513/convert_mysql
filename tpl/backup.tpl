<div class="row">
    <div class="col text-center">
        <h2>{$smarty.const.ETP3}</h2>
    </div>
</div>
    <div class="row">
    <div class="col text-center" id="erreur">
    </div>
</div>
<div class="row">
    <div class="col">
           <ul class="list-group"> 
               {foreach $backup_etape as $value}
                   <li class=list-group-item disabled" aria-disabled="true" id="{$value@key}">{$value} <span class="badge badge-secondary visible" id="{$value@key}_a_faire">{$smarty.const.A_FAIRE}</span> <span class="badge badge-success invisible" id="{$value@key}_success">{$smarty.const.SUCCESS}</span></li>
               {/foreach}
           </ul>
    </div>
</div>
<div class="row">
    <div class="col">
        <form method="post">
           <input type="hidden" name="op" value="4" />
           <input type="hidden" name="cle" value="{$cle}" id="cle"/>
           <input type="hidden" name="username" value="{$username}" id="username"/>
           <input type="hidden" name="database" value="{$database}" id="database"/>
           <input type="hidden" name="host" value="{$host}" id="host"/>
           <input type="hidden" name="langue" value="{$lang}" id="langue"/>
           <input type="hidden" name="db_collation" value="{$db_collation}" id="db_collation" />
           <button type="button" class="btn btn-success" id="lancer" data-load-text="{$smarty.const.PROCESS}">{$smarty.const.BACKUP}</button>
           <button type="button" class="btn btn-primary invisible" id="recup_backup">{$smarty.const.RECUP_BACKUP}</button> 
           <button type="submit" class="btn btn-primary invisible" id="suivant">{$smarty.const.SUITE}</button>
           <p id="lien_backup"></p>
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
        console.log('longueur'+n);
        for( i=0; i<n; i++){
            var val = {
                "c" : encodeURI($("#cle").val()),
                "a" : encodeURI(taches[i]),
                "u" : encodeURI($("#username").val()),
                "h" : encodeURI($("#host").val()),
                "d" : encodeURI($("#database").val()),
                "l" : encodeURI($("#langue").val())
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
                    $(idhide).addClass("invisible");
                    $(id).removeClass("invisible");
                    if ( data.status === 'fin_backup'){
                        $('#recup_backup').attr("onClick","window.location.href=\""+message+"\";");
                        $('#recup_backup').removeClass("invisible");
                        $('#suivant').removeClass("invisible");
                        $('#lancer').addClass("invisible");
                        $('#lien_backup').html("<a href=\""+message+"\">{$smarty.const.LINK_BCK}"+message+"</a>"  );
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
            