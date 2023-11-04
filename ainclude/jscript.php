<script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
<script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"></script>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.1/dist/js/bootstrap.bundle.min.js"></script>

<script>
    // menu toggle
    let toggle = document.querySelector('.toggle');
    let navigation = document.querySelector('.navigation');
    let main = document.querySelector('.main');

    toggle.onclick = function () {
        navigation.classList.toggle('active');
        main.classList.toggle('active');
    }

    // add hover class in selected list item
    let list = document.querySelectorAll('.navigation li')

    function activeLink() {
        list.foreach((item) =>
            item.classList.remove('hovered'));
        item.classList.add('hovered');
    }
    list.foreach((item) =>
        item.addEventListener('mouseover', activeLink))


// $(document).ready(function() {
//     $('.sub-btn').click(function() {
//         $(this).next('.sub-menu').slideToggle();
//     });
// });
</script>


<script type="text/javascript">
    // Dropdown menu items toggle sub-menu scripts.
    $(document).ready(function () {
        $('.sub-btn').click(function () {
            $(this).next('.sub-menu').slideToggle();
            $(this).find('.drop-icon').toggleClass('rotate');

        });
    });
</script>