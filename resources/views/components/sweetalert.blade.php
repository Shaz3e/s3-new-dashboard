<script>
    // Status Changed
    document.addEventListener('statusChanged', () => {
        Swal.fire({
            icon: 'success',
            title: "Status has been updated successfully",
        })
    });

    // Error
    document.addEventListener('error', () => {
        Toast.fire({
            icon: 'error',
            title: "Record not found",
        })
    });

    // Show Delete Confirmation
    document.addEventListener('showDeleteConfirmation', () => {
        Swal.fire({
            title: "Are you sure?",
            text: "You want to delete this record!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "No, cancel!",
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                // Use dispatch() to trigger the delete event
                Livewire.dispatch('deleteConfirmed');
                Swal.fire({
                    title: "Deleted!",
                    text: "The record has been deleted.",
                    icon: "success"
                });
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                Swal.fire(
                    'Cancelled',
                    'This record is safe :)',
                    'error'
                );
            }
        });
    });

    // Show Restore Confirmation
    document.addEventListener('confirmRestore', () => {
        Swal.fire({
            title: "Are you sure?",
            text: "You want to restore this record!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Yes, restore it!",
            cancelButtonText: "No, cancel!",
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                Livewire.dispatch('restored');
                Swal.fire({
                    title: "Restored!",
                    text: "The record has been restored.",
                    icon: "success"
                });
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                Swal.fire(
                    'Cancelled',
                    'This record is still deleted :)',
                    'error'
                );
            }
        });
    });

    // Show Force Delete Confirmation
    document.addEventListener('confirmForceDelete', () => {
        Swal.fire({
            title: "Are you sure?",
            text: "You won't be able to revert this!",
            icon: "warning",
            showCancelButton: true,
            confirmButtonText: "Yes, delete it!",
            cancelButtonText: "No, cancel!",
            reverseButtons: true
        }).then((result) => {
            if (result.isConfirmed) {
                Livewire.dispatch('forceDeleted');
                Swal.fire({
                    title: "Deleted!",
                    text: "The record has been deleted.",
                    icon: "success"
                });
            } else if (result.dismiss === Swal.DismissReason.cancel) {
                Swal.fire(
                    'Cancelled',
                    'This record is deleted but can be restore later :)',
                    'error'
                );
            }
        });
    });
</script>
