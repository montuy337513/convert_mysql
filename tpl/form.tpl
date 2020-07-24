<div class="row">
    <div class="col text-center">
        <h2>{$smarty.const.ETP2}</h2>
    </div>
</div>
    
<div class="row">
    <div class="col">
        {if $message != ''}
        <div class="alert alert-danger" role="alert">
            {$message}
        </div>
        {/if}
        <form method="post">
            <div class="form-group form-check">
                <input type="checkbox" class="form-check-input" id="sauvegarde" name="sauvegarde" />
                <label class="form-check-label" for="sauvegarde">{$smarty.const.SAUVEGARDE}</label>
            </div>
            <div class="form-group">
                <label for="username">{$smarty.const.USERNAME}</label>
                <input type="text" name="username" placeholder="{$smarty.const.USERNAME}" id="username" class="form-control" required="required" value="root"/>
            </div>
            <div class="form-group">
                <label for="password">{$smarty.const.PWD}</label>
                <input type="password" name="password" placeholder="{$smarty.const.PWD}" id="password" class="form-control" value=""/>
            </div>
            <div class="form-group">
                <label for="database">{$smarty.const.DATABASE}</label>
                <input type="text" name="database" placeholder="{$smarty.const.DATABASE}" id="database" class="form-control" required="required" value="amavis_eics3"/>
            </div>
            <div class="form-group">
                <label for="host">{$smarty.const.HOST}</label>
                <input type="text" name="host" placeholder="{$smarty.const.HOST}" id="host" class="form-control" required="required" aria-describedby="hostHelp" value="127.0.0.1"/>
                <small id="hostHelp" class="form-text text-muted">{$smarty.const.HOST_HELP}</small>
            </div>
            <div class="form-group">
                <label for="db_collation">{$smarty.const.DB_COLLATION}</label>
                {$liste_interclassement}
            </div>
            
            <input type="hidden" name="op" value="4" id="op" />
            <input type="hidden" name="cle" value="{$cle}" />
            <input type="hidden" name="langue" value="{$lang}" id="langue"/>
            <button type="submit" class="btn btn-primary">{$smarty.const.SUBMIT}</button>
        </form>
    </div>
</div>
<script type="text/javascript"> 
    $(document).ready(function() {
        $("#sauvegarde").change(function() {
            if ($(this).is(':checked')){
                $("#op").attr('value','3'); 
            }else{
                $("#op").attr('value','4'); 
            }
        });
    });
</script>
    