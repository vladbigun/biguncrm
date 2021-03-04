<!DOCTYPE html>
<html>
<head>
	<title>Авторизация TrueFlex CRM</title>
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
	<meta name="viewport" content="width=device-width, initial-scale=1">
</head>
<body>
<div class="row mt-5">
	<div class="col-lg-12 text-center"><h1>Авторизация</h1></div>
</div>
<div class="row justify-content-center mt-5 p-4">
<div class="col-lg-3">
<form method="post" action="{{route('auth')}}">
	@csrf
	<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text" id="inputGroup-sizing-default">Email</span>
  </div>
  <input type="text" class="form-control" aria-label="Default" name="email" aria-describedby="inputGroup-sizing-default">
</div>


<div class="input-group mb-3">
  <div class="input-group-prepend">
    <span class="input-group-text" id="inputGroup-sizing-default">Пароль</span>
  </div>
  <input type="password" class="form-control" aria-label="Default" name="password" aria-describedby="inputGroup-sizing-default">
</div>
<div class="form-check mb-2 mr-sm-2">
    <input class="form-check-input" type="checkbox" id="inlineFormCheck">
    <label class="form-check-label" for="inlineFormCheck">
      Сохранить
    </label>
  </div>
  <div class="text-center">
	<button type="submite" class="btn btn-success w-50">Войти</button>
 </div>
</form>

</div>
</div>
</body>
</html>

