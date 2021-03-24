const input = document.getElementById('foto');
input.addEventListener('change', tampilPreview);

function tampilPreview(e) {
    let wrapper = document.getElementById('preview-wrapper');
    wrapper.style.height= 'auto';
    wrapper.style.display= 'block';
    wrapper.classList.add('p-3');

    let preview = document.getElementById('foto-upload');
    preview.src = URL.createObjectURL(event.target.files[0]);
    preview.onload = function(){
        URL.revokeObjectURL(preview.src);
    }

    let label = document.getElementById('label');
    label.innerText = 'Ganti Foto';
}

const hapus = document.getElementById('hapus-foto');
hapus.addEventListener('click', hapusFoto);

function hapusFoto() {
    input.value = '';

    let preview = document.getElementById('foto-upload');
    preview.src = '';

    let wrapper = document.getElementById('preview-wrapper');
    wrapper.style.height= '0';
    wrapper.style.display= 'none';
    wrapper.classList.remove('p-3');

    let label = document.getElementById('label');
    label.innerText = 'Tambahkan Foto';
}

const img_diskusi = document.getElementsByClassName('img-diskusi');
for (let i = 0; i < img_diskusi.length; i++) {
    img_diskusi[i].addEventListener('click', tampilTombolDownload);
    img_diskusi[i].d_index = i;
}

function tampilTombolDownload(e) {
    let index = e.currentTarget.d_index;
    let tombol = document.getElementsByClassName('btn-download')[index];

    tombol.classList.toggle('d-none');
}