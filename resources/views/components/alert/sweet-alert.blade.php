<div x-data="{ open: true }" x-show="open"
    @sweet-alert.window="
        const iconColorMap = {
            success: '#4CAF50',   // Hijau untuk success
            error: '#F44336',     // Merah untuk error
            warning: '#FFC107',   // Kuning untuk warning
            info: '#2196F3',      // Biru untuk info
        };

        const iconType = $event.detail.icon;
        const progressBarColor = iconColorMap[iconType] || '#000000'; // Warna default hitam

        Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 2000,
            timerProgressBar: true,
            didOpen: (toast) => {
                toast.addEventListener('mouseenter', Swal.stopTimer)
                toast.addEventListener('mouseleave', Swal.resumeTimer)

                // Ubah warna progress bar sesuai dengan icon
                const progressBar = toast.querySelector('.swal2-timer-progress-bar');
                if (progressBar) {
                    progressBar.style.backgroundColor = progressBarColor;
                }
            }
        }).fire({
            icon: iconType,
            title: $event.detail.title
        })
     "
    style="display: none;">
</div>
