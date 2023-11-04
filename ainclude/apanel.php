<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" type="text/css" href="../css/apanel.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.0/jquery.min.js" charset="utf-8"></script>
</head>


<body>
    <div class="container">
        <div class="navigation">
            <ul>
                <li>
                    <a href="#">
                        <span class="icon">
                            <ion-icon name="logo-apple-appstore"></ion-icon>
                        </span>
                        <span class="title">Brand Name</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="icon">
                            <ion-icon name="home-outline"></ion-icon>
                        </span>
                        <span class="title">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="icon">
                            <ion-icon name="locate-outline"></ion-icon>
                        </span>
                        <span class="title">Area Master</span>
                    </a>
                </li>
                <!-- Dropdown -->
                <li>
                    <div class="item">
                        <a class="sub-btn">
                            <i class="icon">
                                <ion-icon name="locate-outline"></ion-icon>
                            </i>
                            </span>
                            <span class="title">Area Master1</span>
                            <i class="drop-icon">
                                <ion-icon name="chevron-down-outline"></ion-icon>
                            </i>
                        </a>
                        <div class="sub-menu">
                            <i><a href="#">Area-1</a></i>
                            <i><a href="#">Area-2</a></i>
                            <i><a href="#">Area-2</a></i>
                        </div>
                    </div>
                </li>

                <li>
                    <div class="item">
                        <a class="sub-btn">
                            <i class="icon">
                                <ion-icon name="locate-outline"></ion-icon>
                            </i>
                            <i class="title">Service-Master1</i>
                            <i class="drop-icon">
                                <ion-icon name="chevron-down-outline"></ion-icon>
                            </i>
                        </a>
                        <div class="sub-menu">
                            <a href="#" class="sub-item">Service-1</a>
                            <a href="#" class="sub-item">Service-2</a>
                            <a href="#" class="sub-item">Service-2</a>
                        </div>
                    </div>

                </li>

                <li>
                    <a href="#">
                        <span class="icon">
                            <ion-icon name="hammer-outline"></ion-icon>
                        </span>
                        <span class="title">Service Master</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="icon">
                            <ion-icon name="person-outline"></ion-icon>
                        </span>
                        <span class="title">User Master</span>
                    </a>
                </li>
                <li>
                    <a href="#">
                        <span class="icon">
                            <ion-icon name="log-out-outline"></ion-icon>
                        </span>
                        <span class="title">LogOut</span>
                    </a>
                </li>
            </ul>
        </div>

        <!-- main -->
        <div class="main">
            <div class="topbar">
                <div class="toggle">
                    <ion-icon name="grid-outline"></ion-icon>
                </div>
                <!-- search -->
                <div class="search">
                    <label>
                        <input type="text" placeholder>
                        <ion-icon name="search-outline"></ion-icon>
                    </label>
                </div>
                <!-- userImage -->
                <div class="user">
                    <img src="images/favicon.png" alt="">
                </div>
            </div>

            <!-- Card -->
            <div class="cardBox">
                <div class="card">
                    <div>
                        <div class="numbers">1,504</div>
                        <div class="cardName">Service1</div>
                    </div>
                    <div class="iconBx">
                        <ion-icon name="eye-outline"></ion-icon>
                    </div>
                </div>

                <div class="card">
                    <div>
                        <div class="numbers">1,504</div>
                        <div class="cardName">Service2</div>
                    </div>
                    <div class="iconBx">
                        <ion-icon name="eye-outline"></ion-icon>
                    </div>
                </div>

                <div class="card">
                    <div>
                        <div class="numbers">1,504</div>
                        <div class="cardName">Service3</div>
                    </div>
                    <div class="iconBx">
                        <ion-icon name="eye-outline"></ion-icon>
                    </div>
                </div>
                <div class="card">
                    <div>
                        <div class="numbers">1,504</div>
                        <div class="cardName">Service4</div>
                    </div>
                    <div class="iconBx">
                        <ion-icon name="eye-outline"></ion-icon>
                    </div>
                </div>

            </div>

        </div>
    </div>

    <script type="module" src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@7.1.0/dist/ionicons/ionicons.js"></script>

    <script>
    // menu toggle
    let toggle = document.querySelector('.toggle');
    let navigation = document.querySelector('.navigation');
    let main = document.querySelector('.main');

    toggle.onclick = function() {
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
    $(document).ready(function() {
        $('.sub-btn').click(function() {
            $(this).next('.sub-menu').slideToggle();
            $(this).find('.drop-icon').toggleClass('rotate');

        });
    });
    </script>

</body>

</html>