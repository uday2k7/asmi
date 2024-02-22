$(document).ready(function ($) {

    // Upload btn on change call function
    $(".uploadfile").change(function () {
        var filename = readURL(this);
        $(this).parent().children('span').html(filename);
    });

    // Read File and return value
    function readURL(input) {
        var url = input.value;
        var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
        if (input.files && input.files[0] && (
            ext == "png" || ext == "jpeg" || ext == "jpg" || ext == "gif" || ext == "pdf" || ext == "docx" || ext == "txt"
        )) {
            var path = $(input).val();
            var filename = path.replace(/^.*\\/, "");
            // $('.fileUpload span').html('Uploaded Proof : ' + filename);
            return "Uploaded file : " + filename;
        } else {
            $(input).val("");
            return "Only image/pdf/docx formats are allowed!";
        }
    }
    // Upload btn end

});
CKEDITOR.ClassicEditor.create(document.getElementById("campaign_description"), {
toolbar: {
    items: [
        //'heading', '|',
        'bold', 'underline', 'italic'
    ],
    shouldNotGroupWhenFull: true
},
list: {
    properties: {
        styles: true,
        startIndex: true,
        reversed: true
    }
},
heading: {
    options: [
        { model: 'paragraph', title: 'Paragraph', class: 'ck-heading_paragraph' },
        { model: 'heading1', view: 'h1', title: 'Heading 1', class: 'ck-heading_heading1' },
        { model: 'heading2', view: 'h2', title: 'Heading 2', class: 'ck-heading_heading2' },
        { model: 'heading3', view: 'h3', title: 'Heading 3', class: 'ck-heading_heading3' },
        { model: 'heading4', view: 'h4', title: 'Heading 4', class: 'ck-heading_heading4' },
        { model: 'heading5', view: 'h5', title: 'Heading 5', class: 'ck-heading_heading5' },
        { model: 'heading6', view: 'h6', title: 'Heading 6', class: 'ck-heading_heading6' }
    ]
},
placeholder: 'Add Media',
fontFamily: {
    options: [
        'default',
        'Arial, Helvetica, sans-serif',
        'Courier New, Courier, monospace',
        'Georgia, serif',
        'Lucida Sans Unicode, Lucida Grande, sans-serif',
        'Tahoma, Geneva, sans-serif',
        'Times New Roman, Times, serif',
        'Trebuchet MS, Helvetica, sans-serif',
        'Verdana, Geneva, sans-serif'
    ],
    supportAllValues: true
},
fontSize: {
    options: [10, 12, 14, 'default', 18, 20, 22],
    supportAllValues: true
},
htmlSupport: {
    allow: [
        {
            name: /.*/,
            attributes: true,
            classes: true,
            styles: true
        }
    ]
},
htmlEmbed: {
    showPreviews: true
},
link: {
    decorators: {
        addTargetToExternalLinks: true,
        defaultProtocol: 'https://',
        toggleDownloadable: {
            mode: 'manual',
            label: 'Downloadable',
            attributes: {
                download: 'file'
            }
        }
    }
},
mention: {
    feeds: [
        {
            marker: '@',
            feed: [
                '@apple', '@bears', '@brownie', '@cake', '@cake', '@candy', '@canes', '@chocolate', '@cookie', '@cotton', '@cream',
                '@cupcake', '@danish', '@donut', '@dragée', '@fruitcake', '@gingerbread', '@gummi', '@ice', '@jelly-o',
                '@liquorice', '@macaroon', '@marzipan', '@oat', '@pie', '@plum', '@pudding', '@sesame', '@snaps', '@soufflé',
                '@sugar', '@sweet', '@topping', '@wafer'
            ],
            minimumCharacters: 1
        }
    ]
},
removePlugins: [
    'CKBox',
    'CKFinder',
    'EasyImage',
    'RealTimeCollaborativeComments',
    'RealTimeCollaborativeTrackChanges',
    'RealTimeCollaborativeRevisionHistory',
    'PresenceList',
    'Comments',
    'TrackChanges',
    'TrackChangesData',
    'RevisionHistory',
    'Pagination',
    'WProofreader',
    'MathType'
]
});