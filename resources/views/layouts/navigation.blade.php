
<div class="offcanvas-start" id="toggle_sidebar">
    <div class="offcanvas-body">
        <div class="col-xxl-2 col-xl-2 col-lg-3 col-md-3 col-sm-4 position-fixed top-0 start-0 h-100" id="sidebar">
            <div class="row d-flex justify-content-center align-items-center"><img src="/images/Logo.png" alt="" id="logo"></div>
            <div class="row d-flex flex-column justify-content-between" style="height: 86%;">
                <div class="d-flex flex-column w-100 mt-4" id="links">
                    <a href="{{route('superadmin.dashboard')}}" class="row {{ request()->is('superadmin/dashboard') ? 'active' : '' }} d-flex flex-row align-items-center p-2 m-0" id="link">
                        <div class="col-3">
                            <img src="/images/dashboard.png" alt="">
                        </div>
                        <div class="col-9">
                            <p>Dashboard</p>
                        </div>
                    </a>
                    <a href="{{route('superadmin.users.index')}}" class="row d-flex flex-row align-items-center p-2 m-0 {{ request()->is('superadmin/users') ? 'active' : '' }}" id="link">
                        <div class="col-3">
                            <img src="/images/users_management.png" alt="">
                        </div>
                        <div class="col-9">
                            <p>Users Management</p>
                        </div>
                    </a>
                    <a href="#" class="row d-flex flex-row align-items-center p-2 m-0" id="link">
                        <div class="col-3">
                            <img src="/images/property_management.png" alt="">
                        </div>
                        <div class="col-9">
                            <p>Property Management</p>
                        </div>
                    </a>
                    <a href="{{route('superadmin.auctions.index')}}" class="row d-flex flex-row align-items-center p-2 m-0 {{ request()->is('superadmin/auctions') ? 'active' : '' }}" id="link">
                        <div class="col-3">
                            <img src="/images/auction_management.png" alt="">
                        </div>
                        <div class="col-9">
                            <p>Auctions Management</p>
                        </div>
                    </a>
                    <a href="{{route('superadmin.cms')}}" class="row d-flex flex-row align-items-center p-2 m-0 {{ request()->is('superadmin/cms') ? 'active' : '' }}" id="link">
                        <div class="col-3">
                            <img src="/images/CMS.png" alt="">
                        </div>
                        <div class="col-9">
                            <p>CMS</p>
                        </div>
                    </a>
                    <a href="../Billing/billing.html" class="row d-flex flex-row align-items-center p-2 m-0" id="link">
                        <div class="col-3">
                            <img src="/images/credit_card.png" alt="">
                        </div>
                        <div class="col-9">
                            <p>Billing</p>
                        </div>
                    </a>
                    <a href="../Report/report.html" class="row d-flex flex-row align-items-center p-2 m-0" id="link">
                        <div class="col-3">
                            <img src="/images/report.png" alt="">
                        </div>
                        <div class="col-9">
                            <p>Report</p>
                        </div>
                    </a>
                    <a href="../Support/support.html" class="row d-flex flex-row align-items-center p-2 m-0" id="link">
                        <div class="col-3">
                            <img src="/images/support_management.png" alt="">
                        </div>
                        <div class="col-9">
                            <p>Support Management</p>
                        </div>
                    </a>
                    <a href="../IM/instant_messageAdmin.html" class="row d-flex flex-row align-items-center p-2 m-0" id="link">
                        <div class="col-3">
                            <img src="/images/chat_blue.png" alt="">
                        </div>
                        <div class="col-9">
                            <p>IM</p>
                        </div>
                    </a>
                </div>
                <div class="d-flex flex-row" id="bottom_buttons">
                    <div class="col-3 d-flex justify-content-center align-items-center" onclick="showNotifications(event)">
                        <img src="/images/notification.png" alt="">
                    </div>
                    <div class="col-3 d-flex justify-content-center align-items-center">
                        <img src="/images/security.png" alt="">
                    </div>
                    <div class="col-3 d-flex justify-content-center align-items-center">
                        <img src="/images/info.png" alt="">
                    </div>
                    <div class="col-3 d-flex justify-content-center align-items-center">
                        <img src="/images/language.png" alt="">
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
