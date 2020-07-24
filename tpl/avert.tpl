<div class="row">
    <div class="col text-center">
        <h2>{$smarty.const.ETP1}</h2>
    </div>
</div>
<div class="row">
    <div class="col">
        <p>{$smarty.const.ADVERT}</p>
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
                <input type="checkbox" class="form-check-imput" id="ok" name="ok"/>
                <label class="form-check-label" for="ok">{$smarty.const.COMPRIS}</label>
            </div> 
            <input type="hidden" name="op" value="2" />
            <input type="hidden" name="langue" value="{$lang}" id="langue"/>
                <button type="submit" class="btn btn-primary">{$smarty.const.SUBMIT}</button>
        </form><p><br /></p>
        <form id="form_langue" class="form-inline" method="post">
            <label class="sr-only" for="select_langue"><i class="fa fa-globe" aria-hidden="true"></i></label>
            <div class="input-group mb-2 mr-sm-2">
                <div class="input-group-prepend">
                    <div class="input-group-text"><i class="fa fa-globe" aria-hidden="true"></i></div>
                </div>
                <select class="custom-select" aria-labelledby="language-selector-label" id="select_langue" name="langue">
                    <option value="fr" data-iso-code="fr" {if $lang == "fr"} selected="selected" {/if}>Français</option>
                    <option value="en" data-iso-code="en" {if $lang == "en"} selected="selected" {/if}>English</option>
                </select>
            </div>
            </form>
    </div>
</div>
<script type="text/javascript"> 
    $(document).ready(function() {
        $("#select_langue").change(function() {
            $("#form_langue").submit();
        });
    });
</script>

