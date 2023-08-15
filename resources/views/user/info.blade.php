<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Perfil de usuario</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="{{ asset('assets/css/profile.css') }}" />
</head>

<body>

    <div class="container emp-profile">
        <form method="post">
            <div class="row">
                <div class="col-md-4">
                    <div class="profile-img">
                        <img src="../assets/images/profile/foto.jpg" alt="avatar" id="img" />
                        <div class="file btn btn-lg btn-primary">
                            Cambiar foto
                            <input type="file" name="foto" id="foto" accept="image/*" />
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="profile-head">
                        <h5> Pefil de usuario</h5>
                        <h6>Informacion personal del usuario</h6>
                        <br></br>
                        <ul class="nav nav-tabs" id="myTab" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" id="home-tab" data-toggle="tab" href="#home"
                                    role="tab" aria-controls="home" aria-selected="true">Información:</a>
                            </li>
                            <li class="nav-item">
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-md-2">
                    <input type="submit" class="profile-edit-btn" name="btnAddMore" value="Editar perfil" />
                </div>
            </div>
            <div class="row">
                <div class="col-md-4">
                    <div class="profile-work">
                        <p>Usuario</p>
                        <a>fabi0193</a>
                        <p>Tipo de Usuario</p>
                        <a>Estudiante</a>
                    </div>
                </div>

                <div class="col-md-8">
                    <div class="tab-content profile-tab" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel"
                            aria-labelledby="home-tab">
                            <div class="row">
                                <div class="col-md-4">
                                    <label>Nombre</label>
                                </div>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" value="Fabian" name="cedula"
                                        id="cedula" aria-describedby="textHelp" required maxlength="12">
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-4">
                                    <label>Apellido 1</label>
                                </div>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" value="Alvarado" name="nombre"
                                        id="nombre" aria-describedby="textHelp" required maxlength="60">
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-4">
                                    <label>Apellido 2</label>
                                </div>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" value="Ruiz" name="apellido2"
                                        id="apellido2" aria-describedby="textHelp" maxlength="50">
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-4">
                                    <label>Cedula</label>
                                </div>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" name="cedula" value="504360355"
                                        id="cedula" aria-describedby="textHelp" required maxlength="12">
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-4">
                                    <label>Correo</label>
                                </div>
                                <div class="col-md-4">
                                    <input type="email" class="form-control" name="correo"
                                        value="fabian0193@gmail.com" id="correo" aria-describedby="emailHelp"
                                        required maxlength="120">
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-4">
                                    <label>Telefono</label>
                                </div>
                                <div class="col-md-4">
                                    <input type="number" class="form-control" name="telefono" value="85536383"
                                        id="telefono" aria-describedby="textHelp" maxlength="12">
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-4">
                                    <label>Fecha de nacimiento</label>
                                </div>
                                <div class="col-md-4">
                                    <input type="date" class="form-control" value="2000-05-15"
                                        name="fechaDeNacimiento" id="fechaDeNacimiento" aria-describedby="textHelp"
                                        required>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-4">
                                    <label>Usuario</label>
                                </div>
                                <div class="col-md-4">
                                    <input type="text" class="form-control" name="usuario" value="fabi0193"
                                        id="usuario" aria-describedby="textHelp" required maxlength="60">
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-md-4">
                                    <label>Tipo de usuario</label>
                                </div>
                                <div class="col-md-4">
                                    <select name="tipoUsuario" class="form-control" id="tipoUsuario" required
                                        aria-describedby="textHelp">
                                        <option value="">---Seleccione el tipo de usuario--</option>
                                        <option value="1">Profesor</option>
                                        <option value="2" selected="selected">Estudiante</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
        </form>
    </div>
</body>

</html>
