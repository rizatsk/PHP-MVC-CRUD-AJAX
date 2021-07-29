<div class="container">
    <div class="row">
        <div class="col-md-6">
            <h1 class="mb-3">PHP MVC CRUD + AJAX</h1>
            <div class="d-flex justify-content-between">
                <div> <h3>Data Mahasiswa</h3> </div>
                <div> 
                    <button type="button" class="btn btn-outline-success" id="button-modalTambah" data-bs-toggle="modal" data-bs-target="#exampleModal">Tambah Data</button>
                </div>
            </div>
            <div class="mt-4">
              <div class="input-group mb-3">
                <input type="text" class="form-control input-search" placeholder="Search NRP Or Name Press Enter" aria-label="Recipient's username" aria-describedby="button-addon2">
                <button class="btn btn-outline-primary button-search" type="button" id="button-addon2">Search</button>
              </div>
            </div>
            <table class="table">
              <thead>
                <tr>
                  <th scope="col">No</th>
                  <th scope="col">Nama</th>
                  <th scope="col">Action</th>
                </tr>
              </thead>
              <tbody class="table-data-mahasiswa">
                
              </tbody>
            </table>

            <!-- paginate -->
            <div class="paginate">
              <nav aria-label="Page navigation example">
                <ul class="pagination justify-content-center">
                </ul>
              </nav>
            </div>
            <!-- End Paginate -->
        </div>
    </div>

     <!-- Modal Detail -->
     <div class="modal fade" id="exampleModalDetail" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
       <div class="modal-dialog">
         <div class="modal-content">
           <div class="modal-header">
             <h5 class="modal-title-detail" id="exampleModalLabel">Modal title</h5>
             <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
           </div>
           <div class="modal-body-detail">
             
           </div>
           <div class="modal-footer">
             <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
           </div>
         </div>
       </div>
     </div>
    <!-- End Modal Detail -->

    <!-- Modal Tambah Data,Edit Data -->
    <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
       <div class="modal-dialog">
         <div class="modal-content">
           <div class="modal-header">
             <h5 class="modal-title" id="exampleModalLabel">Tambah Data Mahasiswa</h5>
             <button type="button" class="btn-close" id="button-closeX" data-bs-dismiss="modal" aria-label="Close"></button>
           </div>
           <div class="modal-body">
                <input type="hidden" id="input-id">
              <div class="mb-3">
                <label for="input-nama" class="form-label">Nama</label>
                <input type="text" class="form-control" id="input-nama">
              </div>
              <div class="mb-3">
                <label for="input-nrp" class="form-label">NRP</label>
                <input type="number" class="form-control" id="input-nrp">
              </div>
              <div class="mb-3">
                <label for="input-email" class="form-label">Email</label>
                <input type="text" class="form-control" id="input-email">
              </div>
              <div class="mb-3">
                <label for="input-jurusan" class="form-label">Jurusan</label>
                <select class="form-select" id="input-jurusan">
                  <option value="Teknik Informatika">Teknik Informatika</option>
                  <option value="Teknik Lingkungan">Teknik Lingkungan</option>
                  <option value="Teknik Mesin">Teknik Mesin</option>
                  <option value="Sistem Informasi">Sistem Informasi</option>
                </select>
              </div>
           </div>
           <div class="modal-footer">
             <button type="button" class="btn btn-secondary" id="button-close" data-bs-dismiss="modal">Close</button>
             <button type="button" class="btn btn-primary" id="button-edit" data-bs-dismiss="modal">Simpan Data Perubahan</button>
             <buton type="submit" id="button-tambah" class="btn btn-primary" data-bs-dismiss="modal">Tambah Data</button>
           </div>
         </div>
       </div>
     </div>
    <!-- End Modal Tambah Data -->
</div>
