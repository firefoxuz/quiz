
document.addEventListener('livewire:load', function () {

    Livewire.on('toastr', (type,data) => {
        if (type === 'success'){
            toastr.success(data);
        }
        else if(type === 'error'){
            toastr.error(data);
        }
    });
});
