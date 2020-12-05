// constants
const KEYCODE_CARRIAGE_RETURN = 13

// global functions
// used in calculation to parse "100,000.00 | 0.00 | 0 | 1 | undefined => 0"
let parsingDecimal = function (item) {
    if (item === undefined)
        return 0

    // parse to number with two decimal place and sanitize commas
    if (typeof item === "string" && item.includes(','))
        item = item.replace(new RegExp("\\,", 'g'), '')

    return parseFloat(Number(item || 0).toFixed(2))
}

// ajax setup
$.ajaxSetup({
    headers: { 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content') }
})

// prevent form submit on press enter, and instead, trigger the next input if have
$('form').on('keydown', 'input', function (event) {
    if (event.keyCode == 13) {
        event.preventDefault();
    }
})

// allow for popover hints by adding data-toggle="popover"
$('[data-toggle="popover"]').popover()


// trigger to replace the file name after choosing a file
$('.custom-file-input').on('change', function () {
    let customFileGroup = $(this).parents('.custom-file')
    let fileName = $(this)[0].files[0].name
    customFileGroup.find('.custom-file-label').html(fileName)
})

$('.select2').select2({
    theme: 'bootstrap4',
    width: '100%',
    dropdownAutoWidth: true,
})

$('.select2-state-id').select2({
    theme: 'bootstrap4',
    width: '100%',
    dropdownAutoWidth: true,
    templateSelection: function (state) { return state.id },
})

$('.select2-codeonly').select2({
    templateSelection: function (state) { return state.id },
    dropdownAutoWidth: true,
    theme: 'bootstrap4',
}).on('change', function () {
    let url = $(this).data('find-by-code').replace('code', $(this).val())
    if (url && $('.select2-codename')) {
        $.ajax({ 'url': url, 'method': 'GET' }).done(function (response) {
            if (response)
                $('.select2-codename').val(response.data.cr_name)
        })
    }
})

// bootstrap toggle
$('.check').bootstrapToggle({ on: 'Yes', off: 'No' })

// icheck
$('.icheck-primary').iCheck({
    checkboxClass: 'icheckbox_square-blue',
    radioClass: 'iradio_square-blue'
})

// overwrite on keypress enter to be same as shift+enter for a more clean writing (like MS Word)
$.summernote.dom.emptyPara = "<div><br/></div>";

$('.summernote').summernote()
$('.summernote-minimal-option').summernote({
    toolbar: [
        ['style', ['bold', 'italic', 'underline', 'clear']],
        ['font', ['strikethrough', 'superscript', 'subscript']],
        ['para', ['ul', 'ol', 'paragraph']],
    ],
    height: 150,
    minHeight: 150,
    maxHeight: 400,
})

$('.extras-tab').on('click', '.nav-link', function (e) {
    let context = $(this).attr('href')
    $(context).find('.extras-summernote').summernote({
        toolbar: [
            ['style', ['bold', 'italic', 'underline', 'clear']],
            ['font', ['strikethrough', 'superscript', 'subscript']],
            ['para', ['ul', 'ol', 'paragraph']],
        ],
        height: 150,
        minHeight: 150,
        maxHeight: 400,
    })
})
