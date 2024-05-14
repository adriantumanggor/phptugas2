  <!DOCTYPE html>
  <html lang="en">

  <head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>CRUD Nama</title>
    <link rel="stylesheet" href="styles.css">
  </head>

  <body>
    <!-- Tabel -->
    <section id="tabel" class="section">
      <div class="container">
        <h2 class="title">Table</h2>

        <table class="tabel table is-bordered is-fullwidth ce">
          <thead>
            <tr>
              <th colspan="6">
                <h2 class="has-text-centered" style="font-weight: bold">
                  Daftar Mahasiswa
                </h2>
              </th>
            </tr>
            <tr>
              <th class="has-text-centered">No</th>
              <th class="has-text-centered">NRP</th>
              <th class="has-text-centered">Nama</th>
              <th class="has-text-centered">Email</th>
              <th class="has-text-centered">Jenis Kelamin</th>
            </tr>
          </thead>
          <tbody>
            <?php include 'readd.php'; ?>
          </tbody>
        </table>
      </div>
    </section>

  </body>

  </html>