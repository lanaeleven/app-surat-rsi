$(document).ready(function() {
    $('.select2').select2();

    $('#units').on('change', function() {
        let selectedValues = $(this).val() || [];
        const isAllSelected = selectedValues.includes('all');

        // Ambil semua value unit (kecuali 'all')
        const allUnitValues = $('#units option').map(function() {
            const val = $(this).val();
            return val !== 'all' ? val : null;
        }).get();

        if (isAllSelected) {
            // Pilih semua unit, kecuali opsi 'all'
            $('#units').val(allUnitValues).trigger('change.select2');
        }
    });
});