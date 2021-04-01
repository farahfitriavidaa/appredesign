var file = [
    {
        "input": "foto",
        "wrapper": "preview-wrapper-foto",
        "preview": "preview-foto",
    },
    {
        "input": "logo",
        "wrapper": "preview-wrapper-logo",
        "preview": "preview-logo"
    },
    {
        "input": "kemasan",
        "wrapper": "preview-wrapper-kemasan",
        "preview": "preview-kemasan"
    }
];

document.getElementById('foto').addEventListener('change', previewFoto.bind(event, 0));
document.getElementById('logo').addEventListener('change', previewFoto.bind(event, 1));
document.getElementById('kemasan').addEventListener('change', previewImgs.bind(event, 2));

function previewFoto(idx) {
    // console.log(idx);
    // console.log(file[idx]);
    // console.log(file[idx].wrapper);
    let wrapper = document.getElementById(file[idx].wrapper);
    wrapper.style.height= 'auto';
    wrapper.style.display= 'block';

    let preview = document.getElementById(file[idx].preview);
    preview.src = URL.createObjectURL(event.target.files[0]);
    preview.onload = function(){
        URL.revokeObjectURL(preview.src);
    }
}

function previewImgs(idx) {
    let wrapper = document.getElementById(file[idx].wrapper);
    wrapper.style.height= 'auto';
    wrapper.style.display= 'block';
    
    let preview = document.getElementById(file[idx].preview);

    const fileKemasan = event.target.files;

    for (let i = 0; i < fileKemasan.length; i++) {
        let img = document.createElement('img');

        img.alt = 'gambar kemasan yang akan di-upload';
        img.classList.add('img-thumbnail', 'm-2', 'kemasan');
        img.style.maxHeight = '160px';
        img.src = URL.createObjectURL(fileKemasan[i]);
        img.onload = function(){
            URL.revokeObjectURL(img.src);
        }

        // console.log("file: "+fileKemasan[i]);

        preview.appendChild(img);
    }
}

document.getElementById('hapus-foto').addEventListener('click', hapusImg.bind(null, 0));
document.getElementById('hapus-logo').addEventListener('click', hapusImg.bind(null, 1));
document.getElementById('hapus-kemasan').addEventListener('click', hapusImgs.bind(null, 2));

function hapusImg(idx) {
    document.getElementById( file[idx].input ).value = '';

    let preview = document.getElementById(file[idx].preview);
    preview.src = '';

    let wrapper = document.getElementById(file[idx].wrapper);
    wrapper.style.height= '0';
    wrapper.style.display= 'none';
}

function hapusImgs(idx) {
    document.getElementById( file[idx].input ).value = '';

    let preview = document.getElementById(file[idx].preview);

    while (preview.firstChild) {
        preview.removeChild(preview.lastChild);
    }

    let wrapper = document.getElementById(file[idx].wrapper);
    wrapper.style.height= '0';
    wrapper.style.display= 'none';
}
