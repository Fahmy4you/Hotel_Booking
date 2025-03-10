// start: Sidebar
const sidebarToggle = document.querySelector('.sidebar-toggle')
const sidebarOverlay = document.querySelector('.sidebar-overlay')
const sidebarMenu = document.querySelector('.sidebar-menu')
const main = document.querySelector('.main')
if(window.innerWidth < 768) {
    main.classList.toggle('active')
    sidebarOverlay.classList.toggle('active')
    sidebarMenu.classList.toggle('active')
}
sidebarToggle.addEventListener('click', function (e) {
    e.preventDefault()
    main.classList.toggle('active')
    sidebarOverlay.classList.toggle('active')
    sidebarMenu.classList.toggle('active')
})
sidebarOverlay.addEventListener('click', function (e) {
    e.preventDefault()
    main.classList.add('active')
    sidebarOverlay.classList.add('active')
    sidebarMenu.classList.add('active')
})
document.querySelectorAll('.sidebar-dropdown-toggle').forEach(function (item) {
    item.addEventListener('click', function (e) {
        e.preventDefault()
        const parent = item.closest('.group')
        if (parent.classList.contains('selected')) {
            parent.classList.remove('selected')
        } else {
            document.querySelectorAll('.sidebar-dropdown-toggle').forEach(function (i) {
                i.closest('.group').classList.remove('selected')
            })
            parent.classList.add('selected')
        }
    })
})
// end: Sidebar



// start: Popper
const popperInstance = {}
document.querySelectorAll('.dropdown').forEach(function (item, index) {
    const popperId = 'popper-' + index
    const toggle = item.querySelector('.dropdown-toggle')
    const menu = item.querySelector('.dropdown-menu')
    menu.dataset.popperId = popperId
    popperInstance[popperId] = Popper.createPopper(toggle, menu, {
        modifiers: [
            {
                name: 'offset',
                options: {
                    offset: [0, 8],
                },
            },
            {
                name: 'preventOverflow',
                options: {
                    padding: 24,
                },
            },
        ],
        placement: 'bottom-end'
    });
})
document.addEventListener('click', function (e) {
    const toggle = e.target.closest('.dropdown-toggle')
    const menu = e.target.closest('.dropdown-menu')
    if (toggle) {
        const menuEl = toggle.closest('.dropdown').querySelector('.dropdown-menu')
        const popperId = menuEl.dataset.popperId
        if (menuEl.classList.contains('hidden')) {
            hideDropdown()
            menuEl.classList.remove('hidden')
            showPopper(popperId)
        } else {
            menuEl.classList.add('hidden')
            hidePopper(popperId)
        }
    } else if (!menu) {
        hideDropdown()
    }
})

function hideDropdown() {
    document.querySelectorAll('.dropdown-menu').forEach(function (item) {
        item.classList.add('hidden')
    })
}
function showPopper(popperId) {
    popperInstance[popperId].setOptions(function (options) {
        return {
            ...options,
            modifiers: [
                ...options.modifiers,
                { name: 'eventListeners', enabled: true },
            ],
        }
    });
    popperInstance[popperId].update();
}
function hidePopper(popperId) {
    popperInstance[popperId].setOptions(function (options) {
        return {
            ...options,
            modifiers: [
                ...options.modifiers,
                { name: 'eventListeners', enabled: false },
            ],
        }
    });
}
// end: Popper



// start: Tab
document.querySelectorAll('[data-tab]').forEach(function (item) {
    item.addEventListener('click', function (e) {
        e.preventDefault()
        const tab = item.dataset.tab
        const page = item.dataset.tabPage
        const target = document.querySelector('[data-tab-for="' + tab + '"][data-page="' + page + '"]')
        document.querySelectorAll('[data-tab="' + tab + '"]').forEach(function (i) {
            i.classList.remove('active')
        })
        document.querySelectorAll('[data-tab-for="' + tab + '"]').forEach(function (i) {
            i.classList.add('hidden')
        })
        item.classList.add('active')
        target.classList.remove('hidden')
    })
})
// end: Tab

// Ambil elemen input file dan elemen gambar preview
const fileInput = document.getElementById('fileInput');
const previewImage = document.getElementById('previewImage');
const buttonHapusProfile = document.querySelector('.hapusProfile');
const cekHapusProfileInput = document.querySelector('#hapusProfile');

if(buttonHapusProfile) {

    buttonHapusProfile.addEventListener('click', (e) => {
        e.preventDefault();
        previewImage.src = previewImage.getAttribute('default-image');
        buttonHapusProfile.style.display = 'none';
        fileInput.value = "";
        cekHapusProfileInput.value = "true";
    })

    buttonHapusProfile.style.display = 'none';
    let nameFileNow = previewImage.src.split('/');
    nameFileNow = nameFileNow.pop()
    if(nameFileNow != 'default.jpg') {
        buttonHapusProfile.style.display = 'block';
    }
}


// Fungsi untuk menampilkan gambar baru
const showPreview = (file) => {
    const reader = new FileReader();
    reader.onload = (event) => {
        // Ubah sumber gambar preview dengan Base64 dari file
        previewImage.src = event.target.result;
    };
    
    if(buttonHapusProfile) {
        if(cekHapusProfileInput) {
            cekHapusProfileInput.value = "false";
        }
        buttonHapusProfile.style.display = 'block';
    }
    reader.readAsDataURL(file); // Baca file sebagai Data URL (Base64)
};

// Event listener untuk input file
if(fileInput) {

    fileInput.addEventListener('change', function () {
        const file = fileInput.files[0]; // Ambil file pertama dari input
        if (file) {
            previewImage.style.display = 'block';
            // Jika file dipilih, tampilkan preview
            showPreview(file);
        }
    });
}

// **Contoh Penggunaan: Create & Edit**
// Mode Create: Kosongkan gambar jika tidak ada data awal
// Mode Edit: Tampilkan gambar dari server
if(previewImage) {
    const mode = previewImage.getAttribute('mode'); // Ganti dengan "create" untuk mode create
    
    if (mode === "create") {
        previewImage.src = ""; // Kosongkan preview
        previewImage.style.display = 'none';
        previewImage.alt = "Belum ada gambar yang dipilih";
    } else if (mode === "edit") {
        // Ambil URL gambar dari server (contoh placeholder di sini)
        previewImage.src = previewImage.getAttribute('src');
        previewImage.alt = "Gambar Awal";
    }

}

function myconfirm(event, message) {
    if(!confirm(message)) {
        event.preventDefault();
    }
}