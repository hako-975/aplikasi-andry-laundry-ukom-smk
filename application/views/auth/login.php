<style>
  * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
  }

  body {
    min-height: 100vh;
    background-image: url(<?= base_url(); ?>/assets/img/img_properties/background.jpg);
    background-size: cover;
    background-repeat: no-repeat;
  }

  .container {
    position: absolute;
    left: 50%;
    top: 50%;
    transform: translate(-50%, -50%);
  }
</style>

<div class="container">
	<div class="row justify-content-center my-2">
		<div class="col-lg-5 mx-5 border border-success rounded bg-info text-white p-5">
			<h1 class="text-center">Andry Laundry</h1>
			<h2>Masuk</h2>
			<form method="post">
			  <div class="form-group">
			    <label for="username"><i class="fas fa-fw fa-user"></i> Nama Pengguna</label>
			    <input required type="text" autocomplete="off" id="username" class="form-control rounded-pill" name="username">
			  </div>
			  <div class="form-group">
			    <label for="password"><i class="fas fa-fw fa-lock"></i> Kata Sandi</label>
			    <input required type="password" id="password" class="form-control rounded-pill" name="password">
			  </div>
			  <div class="form-group text-right">
			    <button type="submit" name="login" class="btn btn-success rounded-pill"><i class="fas fa-fw fa-sign-in-alt"></i> Masuk</button>
			  </div>
			</form>
		</div>
	</div>
</div>