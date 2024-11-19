<script>
    document.addEventListener('DOMContentLoaded', function() {
        <?php if (isset($_SESSION['toastrNotify'])): ?>
            var type = "<?php echo $_SESSION['toastrNotify']['alert-type']; ?>";
            var message = "<?php echo $_SESSION['toastrNotify']['message']; ?>";

            switch (type) {
                case 'info':
                    toastr.info(message);
                    break;
                case 'success':
                    toastr.success(message);
                    break;
                case 'warning':
                    toastr.warning(message);
                    break;
                case 'error':
                    toastr.error(message);
                    break;
            }
            <?php unset($_SESSION['toastrNotify']); ?>
        <?php endif; ?>

        <?php if (isset($_SESSION['formData'])) {
            unset($_SESSION['formData']);
        }
        ?>
    });
</script>