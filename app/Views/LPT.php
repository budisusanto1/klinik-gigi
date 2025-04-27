<main id="main" class="main">
  <div class="pagetitle">
    <h1>Table pesanan</h1>
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
            <!-- <h3>laporan pesanan</h3> -->
            <!-- <form action="<?= base_url('home/tabelpt') ?>" method="post"> -->
          <!--     <div class="row">
                <div class="col">
                  <label for="awal" class="form-label">tanggalawal:</label>
                   <input type="date" class="form-control" placeholder="tanggalawal" name="tanggalawal">
                </div>
                <div class="col">
                  <label for="akhir" class="form-label">tanggalakhir:</label>
                  <input type="date" class="form-control" placeholder="tanggalakhir" name="tanggalakhir">
                </div>
                <div class="col" class="form-control">
                    <button type="print" class="btn btn-primary" ?>
                      <i class="fas fa-print"></i>
                      Cetak
                    </button></a> 
                  </div>
                </form> -->


                <h3>laporan pesanan</h3>
                <form action="<?= base_url('home/tabelpt') ?>" method="post">
                  <div class="row">
                    <div class="col">
                      <label for="awal" class="form-label">tanggalawal:</label>
                    </div>
                    <div class="col">
                      <label for="akhir" class="form-label">tanggalakhir:</label>
                    </div>
                    <div class="col" class="form-control">
                    </div>

                    <div class="row">
                      <div class="col">
                        <input type="date" class="form-control" placeholder="tanggalawal" name="tanggalawal">
                      </div>
                      <div class="col">
                        <input type="date" class="form-control" placeholder="tanggalakhir" name="tanggalakhir">
                      </div>
                      <div class="col" class="form-control">
                        <a href="<?= base_url('home/tabelpt/')?>"><button type="print" class="btn btn-danger" ?>
                          <i class="fas fa-file-pdf"></i>
                          pdf
                        </button></a> 
                      </div>
                    </form>

                 <!--    <h3>laporan pesanan </h3>
                    <form action="<?= base_url('home/tabelpt') ?>" method="post">
                      <div class="row">
                        <div class="col">
                          <label for="awal" class="form-label">tanggalawal:</label>
                        </div>
                        <div class="col">
                          <label for="akhir" class="form-label">tanggalakhir:</label>
                        </div>
                        <div class="col" class="form-control">
                        </div>

                        <div class="row">
                          <div class="col">
                            <input type="date" class="form-control" placeholder="tanggalawal" name="tanggalawal">
                          </div>
                          <div class="col">
                            <input type="date" class="form-control" placeholder="tanggalakhir" name="tanggalakhir">
                          </div>
                          <div class="col" class="form-control">
                            <a href="<?= base_url('home/tabelpt/')?>"><button type="print" class="btn btn-success" ?>
                              <i class="fas fa-file-excel"></i>
                              excel
                            </button></a> 
                          </div>
                        </form> -->

                      </form>
                    </div>
                  </div>
                </div>
              </div>
            </section>
          </main>
