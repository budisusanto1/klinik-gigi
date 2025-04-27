 <main id="main" class="main">
  <div class="pagetitle">
    <h1>edit user</h1>
    <nav>
      <ol class="breadcrumb">
        <li class="breadcrumb-item"><a href="index.html">Home</a></li>
        <li class="breadcrumb-item">Tables</li>
        <li class="breadcrumb-item active">Data</li>
      </ol>
    </nav>
  </div><!-- End Page Title -->

  <section class="section">
    <div class="row">
      <div class="col-lg-12">
        <div class="card">
          <div class="card-body">
            <h2>Form Edit user</h2>
<form action="<?=base_url('Home/simpan_user')?>" method="post">
  <!-- <form action="<?=base_url('Home/inputuser')?>" method="Post"> -->
      <div class="mb-3">
     <label for="pwd"class="form-label">Username</label>
     <input type="text" class="form-control" id="username" placeholder="Masukkan username" name="username" 
      value="<?= $es1->username?>">
   </div>
   
   <div class="mb-3">
     <label for="pwd"class="form-label">password</label>
     <input type="password" class="form-control" id="password" placeholder="Masukkan password" name="password" 
      value="<?= $es1->password ?>">
   </div>
   <div class="mb-3">
     <label for="email"class="form-label">email</label>
     <input type="email" class="form-control" id="email" placeholder="Masukkan email" name="email" 
      value="<?= $es1->email ?>">
   </div>
   <div class="mb-3">
     <label for="pwd"class="form-label">level</label>
     <input type="number" class="form-control" id="level" placeholder="Masukkan level  " name="level" 
      value="<?= $es1->level ?>">
   </div>

   <input type="hidden" value="<?=$es1->id_user?>" name="id">
   <button type="submit" class="btn btn-primary">Submit</button> 
</form>
  </div>
        </div>
      </div>
    </div>
  </section>
</main>