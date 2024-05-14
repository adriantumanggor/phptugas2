<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>INPUTT</title>
  <!-- Menggunakan Bulma CSS -->
  <link rel="stylesheet" href="styles.css" />
</head>

<body>
  
  <section id="input" class="section">
    <div class="container">
      <h2 class="title">Input Data Baru</h2>

      <form action="createe.php" method="POST">

        <div class="field is-horizontal">
          <div class="field-label is-normal">
            <label class="label">Nama</label>
          </div>
          <div class="field-body">
            <div class="field">
              <p class="control is-expanded">
                <input class="input" type="text" name="nama" placeholder="Masukkan nama" required />
              </p>
            </div>
          </div>
        </div>
        <div class="field is-horizontal">
          <div class="field-label is-normal">
            <label class="label">Email</label>
          </div>
          <div class="field-body">
            <div class="field">
              <p class="control is-expanded">
                <input class="input" type="email" name="email" placeholder="Masukkan email" required />
              </p>
            </div>
          </div>
        </div>
        <div class="field is-horizontal">
          <div class="field-label is-normal">
            <label class="label">NRP</label>
          </div>
          <div class="field-body">
            <div class="field">
              <p class="control is-expanded">
                <input class="input" type="text" name="nrp" placeholder="Masukkan NRP" required />
              </p>
            </div>
          </div>
        </div>
        <div class="field is-horizontal">
          <div class="field-label is-normal">
            <label class="label">Jenis Kelamin</label>
          </div>
          <div class="field-body">
            <div class="field">
              <div class="control">
                <label class="radio">
                  <input type="radio" name="jenis_kelamin" value="Laki-laki" required>
                  Laki-laki
                </label>
                <label class="radio">
                  <input type="radio" name="jenis_kelamin" value="Perempuan" required>
                  Perempuan
                </label>
              </div>
            </div>
          </div>
        </div>
        <div class="field is-horizontal">
          <div class="field-label is-normal">
            <label class="label">Jurusan</label>
          </div>
          <div class="field-body">
            <div class="field">
              <p class="control is-expanded">
                <input class="input" type="text" name="jurusan" placeholder="Masukkan jurusan" required />
              </p>
            </div>
          </div>
        </div>
        <div class="field is-horizontal">
          <div class="field-label is-normal">
            <label class="label">Alamat</label>
          </div>
          <div class="field-body">
            <div class="field">
              <p class="control is-expanded">
                <textarea class="textarea" name="alamat" placeholder="Masukkan alamat" required></textarea>
              </p>
            </div>
          </div>
        </div>
        <div class="field is-horizontal">
          <div class="field-label is-normal">
            <label class="label">No HP</label>
          </div>
          <div class="field-body">
            <div class="field">
              <p class="control is-expanded">
                <input class="input" type="tel" name="no_hp" placeholder="Masukkan nomor HP" required />
              </p>
            </div>
          </div>
        </div>
        <div class="field is-horizontal">
          <div class="field-label is-normal">
            <label class="label">Asal SMA</label>
          </div>
          <div class="field-body">
            <div class="field">
              <p class="control is-expanded">
                <input class="input" type="text" name="asal_sma" placeholder="Masukkan asal SMA" required />
              </p>
            </div>
          </div>
        </div>
        <div class="field is-horizontal">
          <div class="field-label is-normal">
            <label class="label">Mata Kuliah Favorit</label>
          </div>
          <div class="field-body">
            <div class="field">
              <p class="control is-expanded">
                <input class="input" type="text" name="mata_kuliah_favorit" placeholder="Masukkan mata kuliah favorit"
                  required />
              </p>
            </div>
          </div>
        </div>
        <div class="field is-horizontal">
          <div class="field-label"></div>
          <div class="field-body">
            <div class="field">
              <p class="control">
                <button class="button is-primary">Simpan</button>
              </p>
            </div>
          </div>
        </div>
      </form>
    </div>
  </section>

  <script src="script.js"></script>
</body>

</html>