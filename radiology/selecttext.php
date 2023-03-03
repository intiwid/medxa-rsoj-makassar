<a href="#" class="select-text" data-selector="#some-container">Select all</a>
<div id="some-container">
    <p>
        Dilakukan MRI femur dextra dengan potongan axial-coronal-sagital T1WI, axial-coronal-sagital T2WI dan T2-STIR. Scanning dilakukan tanpa dan dengan kontras media.
    </p>
</div>


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>
<script>
    jQuery.fn.selectText = function() {
        this.find('input').each(function() {
            if ($(this).prev().length == 0 || !$(this).prev().hasClass('p_copy')) {
                $('<p class="p_copy" style="position: absolute; z-index: -1;"></p>').insertBefore($(this));
            }
            $(this).prev().html($(this).val());
        });
        var doc = document;
        var element = this[0];
        console.log(this, element);
        if (doc.body.createTextRange) {
            var range = document.body.createTextRange();
            range.moveToElementText(element);
            range.select();
        } else if (window.getSelection) {
            var selection = window.getSelection();
            var range = document.createRange();
            range.selectNodeContents(element);
            selection.removeAllRanges();
            selection.addRange(range);
        }
    };

    $('.select-text').on('click', function(e) {
        var selector = $(this).data('selector');
        $(selector).selectText();
        e.preventDefault();
    });
</script>