<div class="form-content">
    <form method="POST" action="#" class="form-general comments">

        <div class="form-group fs-5">
            <label for="start-label-title">Déjanos tu calificación:</label>
        </div>
        <div class="form-group rating">
            <input id="star5" name="value" type="radio" value="5" class="radio-btn hide" checked />
            <label for="star5">☆</label>
            <input id="star4" name="value" type="radio" value="4" class="radio-btn hide" />
            <label for="star4">☆</label>
            <input id="star3" name="value" type="radio" value="3" class="radio-btn hide" />
            <label for="star3">☆</label>
            <input id="star2" name="value" type="radio" value="2" class="radio-btn hide" />
            <label for="star2">☆</label>
            <input id="star1" name="value" type="radio" value="1" class="radio-btn hide" />
            <label for="star1">☆</label>
            <div class="clear"></div>
   
            <span class="text-danger">
                <span>*</span>
            </span>

        </div>

        <div class="form-group">
            <textarea name='description' id="description"></textarea>

            <span class="text-danger">
                <span>*</span>
            </span>

        </div>

        <div class="form-group"><input type="hidden" name="article_id" value=""></div>

        <input type="submit" value="Enviar comentario" class="btn-submit btn-comment mt-2">

    </form>
</div>