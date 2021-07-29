
const URL = 'http://localhost/php mvc + ajax/public'

const   dataPerhalaman = 4

getAllMahasiswa()
getPaginate()

function getAllMahasiswa(halaman){
    $('.table-data-mahasiswa').html('')
    $.ajax({
        type : 'POST',
        url : URL+'/mahasiswa/getAllMahasiswa',
        dataType : 'JSON',
        data : {
            'dataPerhalaman' : dataPerhalaman,
            'halaman' : halaman
        },
        success : function(result){
        // }
            let no = 1;
            $.each(result, function(i,data){
                $('.table-data-mahasiswa').append(`
                <tr>
                    <th scope="row">`+ no++ +`</th>
                    <td>`+ data.nama +`</td>
                    <td>
                    <button type="button" class="btn btn-outline-info" id="button-detail" data-bs-toggle="modal" data-bs-target="#exampleModalDetail" data-id="`+ data.id +`">Detail</button> |
                    <button type="button" class="btn btn-outline-primary" id="button-modalEdit" data-bs-toggle="modal" data-bs-target="#exampleModal" data-id="`+ data.id +`">Edit</button> |
                    <button type="button" class="btn btn-outline-danger" id="button-delete" data-id="`+ data.id +`">Delete</button>
                    </td>
                </tr>`)
            })
        }
    })
}

function getPaginate(halaman){
    $('.pagination').html('')
    $.ajax({
        type : 'POST',
        url : URL+'/mahasiswa/getPaginateMahasiswa',
        dataType : 'JSON',
        data : {
            'dataPerhalaman' : dataPerhalaman,
            'halaman' : halaman
        },
        success : function(result){
            for(var i = 1; i <= result.jumlahHalaman; i++){
                if(i == result.halamanAktif){
                    $('.pagination').append(`
                          <li class="page-item active halaman"><a class="page-link" data-id="`+i+`">`+i+`</a></li>
                    `)
                }else{
                    $('.pagination').append(`
                          <li class="page-item halaman"><a class="page-link" data-id="`+i+`">`+i+`</a></li>
                    `)
                }
        }
        }
    })
}

$('.pagination').on('click','.page-link',function(){
    var halaman = $(this).data('id') 
    getAllMahasiswa(halaman)
    getPaginate(halaman)
})

$('.table-data-mahasiswa').on('click','#button-detail',function(){
    detailMahasiswa($(this).data('id'))
})

function detailMahasiswa(id)
{
    $.ajax({
        type : 'POST',
        url : URL+'/mahasiswa/getDetailMahasiswa',
        dataType : 'JSON',
        data : {
            'id' : id 
        },
        success : function(result){
            $('.modal-title-detail').html(`Data Mahasiswa `+result.nama)
            $('.modal-body-detail').html(`
            <ul class="list-group">
              <li class="list-group-item">Nama : `+result.nama+`</li>
              <li class="list-group-item">NRP : `+result.nrp+`</li>
              <li class="list-group-item">Email : `+result.email+`</</li>
              <li class="list-group-item">Jurusan : `+result.jurusan+`</li>
            </ul>
            `)
        }
    })
}

$('#button-tambah').on('click',function(){
    tambahMahasiswa()
})

function tambahMahasiswa()
{
    var nama = $('#input-nama').val()
    var nrp = $('#input-nrp').val()
    var email = $('#input-email').val()
    var jurusan = $('#input-jurusan').val()
    
    $.ajax({
        type : 'POST',
        url : URL+'/mahasiswa/tambahDataMahasiswa',
        dataType : 'JSON',
        data : {
            'nama' : nama,
            'nrp' : nrp,
            'email' : email,
            'jurusan' : jurusan
        },
        success : function(data){
            if(data['status'] === 1){
                alert(data['message']);
                getAllMahasiswa()
                getPaginate()
                resetForm()
            }else{
                alert(data['message']);
                getAllMahasiswa()
                getPaginate()
                resetForm()
            }
        }
    })
}

// button Close
$('#button-closeX').on('click',function(){
    resetForm()
})

$('#button-close').on('click',function(){
    resetForm()
})
// End Button Close

// Tombol Modal Tambah Data Mahasiswa
$('#button-modalTambah').on('click',function(){  
    $('.modal-title').html('Tambah Data Mahasiswa')
    resetForm()
    $('#button-edit').hide()
    $('#button-tambah').show()
})

// Tombol Modal Edit Mahasiswa
$('.table-data-mahasiswa').on('click','#button-modalEdit',function(){
    getIdMahasiswa($(this).data('id'))
})

function getIdMahasiswa(id)
{
    $.ajax({
        type : 'POST',
        url : URL+'/mahasiswa/getDetailMahasiswa',
        dataType : 'JSON',
        data : {
            'id' : id 
        },
        success : function(result){
            $('.modal-title').html(`Edit Data Mahasiswa `+result.nama)
            $('#button-edit').show()
            $('#button-tambah').hide()

            $('#input-id').val(result.id)
            $('#input-nama').val(result.nama)
            $('#input-nrp').val(result.nrp)
            $('#input-email').val(result.email)
            $('#input-jurusan').val(result.jurusan)
        }
    })
}
// End Edit Mahasiswa

// Tombol Edit Data Mahasiswa
$('#button-edit').on('click',function(){
    editDataMahasiswa()
})

function editDataMahasiswa()
{
    var id = $('#input-id').val()
    var nama = $('#input-nama').val()
    var nrp = $('#input-nrp').val()
    var email = $('#input-email').val()
    var jurusan = $('#input-jurusan').val()
    
    $.ajax({
        type : 'POST',
        url : URL+'/mahasiswa/editMahasiswa',
        dataType : 'JSON',
        data : {
            'id' : id,
            'nama' : nama,
            'nrp' : nrp,
            'email' : email,
            'jurusan' : jurusan
        },
        success : function(data){
            if(data['status'] === 1){
                alert(data['message']);
                getAllMahasiswa()
                getPaginate()
                resetForm()
            }else{
                alert(data['message']);
                getAllMahasiswa()
                getPaginate()
                resetForm()
            }
        }
    })
}
// End Tombol Edit Data

// Tombol Hapus Data
$('.table-data-mahasiswa').on('click','#button-delete',function(){
    deleteMahasiswa($(this).data('id'))
})

function deleteMahasiswa(id)
{
    $.ajax({
        type : 'POST',
        url : URL+'/mahasiswa/deleteDataMahasiswa',
        dataType : 'JSON',
        data : {
            'id' : id
        },
        success : function(data){
            if(data['status'] === 1){
                alert(data['message']);
                getAllMahasiswa()
                getPaginate()
                resetForm()
            }else{
                alert(data['message']);
                getAllMahasiswa()
                getPaginate
                resetForm()
            }
        }
    })
}
// End Tombol Hapus Data

function resetForm()
{
    $('#input-nama').val('')
    $('#input-nrp').val('')
    $('#input-email').val('')
    $('#input-jurusan').val('')
}

$('.button-search').on('click',function(){
    searchData($('.input-search').val())
    getPaginate()
})

$('.input-search').on('keyup',function(){
    if(event.keyCode === 13){
        searchData($('.input-search').val())
        getPaginate()
    }
})

function searchData(keyword){
    $.ajax({
        type : 'POST',
        url : URL+'/mahasiswa/searchData',
        dataType : 'JSON',
        data : {
            'keyword' : keyword
        },success : function(result){
            if(result.return == 0){
                $('.table-data-mahasiswa').html(`
                <tr>
                    <td></td>
                    <td> <h5 class='text-center mt-5'>`+result.message+`</h5> </td>
                </tr>    
                    `)
            }else{
            let no = 1;
            // 
            $('.table-data-mahasiswa').html('')
            $.each(result, function(i,data){
                $('.table-data-mahasiswa').append(`
                <tr>
                    <th scope="row">`+ no++ +`</th>
                    <td>`+ data.nama +`</td>
                    <td>
                    <button type="button" class="btn btn-outline-info" id="button-detail" data-bs-toggle="modal" data-bs-target="#exampleModalDetail" data-id="`+ data.id +`">Detail</button> |
                    <button type="button" class="btn btn-outline-primary" id="button-modalEdit" data-bs-toggle="modal" data-bs-target="#exampleModal" data-id="`+ data.id +`">Edit</button> |
                    <button type="button" class="btn btn-outline-danger" id="button-delete" data-id="`+ data.id +`">Delete</button>
                    </td>
                </tr>`)
                })
            }
        }
    })
}
