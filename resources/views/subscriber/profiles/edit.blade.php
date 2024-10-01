<div class="btn-article">
    <a href="#" class="btn-new-article">⬅</a>
</div>

<div class="main-content">
    <div class="title-page-admin">
        <h2>Editar Perfil</h2>
    </div>
    <form method="POST" action="#" enctype="multipart/form-data"
        class="form-article">
        <div class="content-create-article">

            <div class="input-content">
                <label for="name">Nombre completo:</label>
                <input type="text" name="full_name" placeholder="Escribe tu nombre completo"
                    value="" autofocus>

                <span class="text-danger">
                    <span>*</span>
                </span>

            </div>

            <div class="input-content">
                <label for="email">Correo eléctronico</label>
                <input type="text" name="email" placeholder="Correo eléctronico" value=""
                    autofocus>

                <span class="text-danger">
                    <span>*</span>
                </span>

            </div>

            <div class="input-content">
                <label for="image">Foto de perfil</label> <br>
                <input type="file" id="photo" accept="image/*" name="photo" class="form-input-file">

                <label>Foto actual</label>
                <div class="img-article">
                    <img src="" class="img">
                </div>

                <span class="text-danger">
                    <span>*</span>
                </span>

            </div>

            <input type="submit" value="Editar perfil" class="button">
    </form>
</div>
