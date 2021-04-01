var input_file = document.getElementsByClassName('form-control-file');

for (let i = 0; i < input_file.length; i++) {
    input_file[i].addEventListener('change', validasiFile);
}

function validasiFile(event) {
    let files = event.target.files;
    let pesan_err1 = [];
    let pesan_err2 = [];

    for (let i = 0; i < files.length; i++) {
        let nama_file = files[i].name;
        let ext_file = nama_file.split('.').pop().toLowerCase();
        let ukuran_file = files[i].size;

        let is_ext_valid = cekEkstensi(ext_file);
        let is_ukuran_valid = cekUkuran(ukuran_file);

        if ( ! is_ext_valid) {
            pesan_err1[i] = `Jenis file tidak diperbolehkan (Hanya menerima .jpg, .jpeg, atau .png) [${nama_file}]`;
        }
    
        if ( ! is_ukuran_valid) {
            pesan_err2[i] = `Ukuran file terlalu besar (Maks. ~16MB) [${nama_file}]`;
        }
    }

    if (pesan_err1 && pesan_err2)
        tampilPesanError(pesan_err1, pesan_err2, event.target.getAttribute('data-input')-1);
}

function cekEkstensi(ext_file) {
    switch (ext_file) {
        case 'jpg':
        case 'jpeg':
        case 'png':
            return true;
    }

    return false;
}

function cekUkuran(ukuran_file) {
    // maks ukuran file sekitar 16MB
    if (ukuran_file > 16000000) {
        return false;
    }

    return true;
}

function tampilPesanError(pesan1, pesan2, idx) {
    let list = document.getElementsByClassName('list-file-error')[idx];
    let li;

    for (let i = 0; i < pesan1.length; i++) {
        li = document.createElement('li');
        li.innerText = pesan1[i];
        list.appendChild(li);
    }

    for (let i = 0; i < pesan2.length; i++) {
        li = document.createElement('li');
        li.innerText = pesan2[i];
        list.appendChild(li);
        console.log(pesan2[i]);
    }
}

document.getElementById('hapus-foto').addEventListener('click', hapusPesanError);
document.getElementById('hapus-logo').addEventListener('click', hapusPesanError);
document.getElementById('hapus-kemasan').addEventListener('click', hapusPesanError);

function hapusPesanError(event) {
    let idx = event.target.getAttribute('data-hapus')-1;

    let list = document.getElementsByClassName('list-file-error')[idx];

    while (list.firstChild) {
        list.removeChild(list.lastChild);
    }
}

var hal_form = 1;
var is_form_valid = false;
var btn_pindah = document.getElementById('btn-back');
btn_pindah.addEventListener('click', cekHalamanPertama);
btn_pindah.addEventListener('click', ambilUsername);

function cekHalamanPertama() {
    let inputs = document.forms['buat-request'];

    for (let i = 0; i < inputs.length - 3; i++) {
        if (inputs[i].type === 'button') {
            continue;
        }
        else if (inputs[i].type === 'file' && inputs[i].files == 0) {
                inputs[i].focus();
                return;
        }
        else if (inputs[i].value === '') {
            inputs[i].focus();
            return;
        }
    }
    
    pindahHalaman();
}

function ambilUsername() {
    let email = document.forms['buat-request']['email'].value;

    if (email == '') {
        return;
    }

    let input_uname = document.getElementById('uname');

    if (input_uname.getAttribute('data-changed') === 'false') {
        let uname = email.split('@')[0];
    
        input_uname.value = uname;
        input_uname.parentNode.classList.add('is-filled');
        input_uname.setAttribute('data-uname', uname);
        let notice = document.getElementById('username-notice');
        let teks_notice = uname == '' ? `` : `Username ${uname} berasal dari email. Ganti bila diinginkan.`
        notice.innerText = teks_notice;
        notice.style.display = 'initial';
    }
}

function pindahHalaman() {
    document.getElementById('hal-pertama').classList.toggle('sembunyi');
    document.getElementById('hal-kedua').classList.toggle('sembunyi');

    let btn_next = document.getElementById('btn-next');
        
    btn_next.setAttribute('type', 'submit');
    btn_next.classList.toggle('sembunyi');

    btn_pindah.innerHTML = '';
    let ikon = document.createElement('i');
    let teks_btn = document.createElement('span');

    if (hal_form === 1) {
        ikon.classList.add('mdi', 'mdi-arrow-left')
        btn_pindah.appendChild(ikon);

        teks_btn.innerText = 'Kembali';
        btn_pindah.appendChild(teks_btn);

        hal_form = 2;
    } else {        
        teks_btn.innerText = 'Selanjutnya';
        btn_pindah.appendChild(teks_btn);

        ikon.classList.add('mdi', 'mdi-arrow-right')
        btn_pindah.appendChild(ikon);

        hal_form = 1;
    }
}

document.getElementById('uname').addEventListener('change', hapusNotice);

function hapusNotice(event) {
    if (event.target.value != event.target.getAttribute('data-uname')) {
        document.getElementById('username-notice').style.display = 'none';
        document.getElementById('uname').setAttribute('data-changed', 'true');
    }
}
