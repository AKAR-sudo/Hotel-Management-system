<?php
session_start();
if(empty($_SESSION['name']))
{
    header('location:index.php');
}
include('header.php');
include('includes/connection.php');
?>
<style>
    /* Enhanced Dashboard Styling */
    .dash-widget {
        transition: all 0.3s ease;
        border-radius: 10px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        overflow: hidden;
        margin-bottom: 20px;
        position: relative;
        z-index: 1;
    }
    
    .dash-widget:hover {
        transform: translateY(-5px);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.15);
    }
    
    .dash-widget-bg1, .dash-widget-bg2, .dash-widget-bg3, .dash-widget-bg4 {
        position: relative;
        overflow: hidden;
        z-index: 1;
    }
    
    .dash-widget-bg1:before, .dash-widget-bg2:before, .dash-widget-bg3:before, .dash-widget-bg4:before {
        content: '';
        position: absolute;
        width: 100%;
        height: 100%;
        background: rgba(255, 255, 255, 0.1);
        top: -50%;
        left: -50%;
        border-radius: 50%;
        transform: scale(0);
        transition: all 0.5s ease;
        z-index: -1;
    }
    
    .dash-widget:hover .dash-widget-bg1:before, 
    .dash-widget:hover .dash-widget-bg2:before, 
    .dash-widget:hover .dash-widget-bg3:before, 
    .dash-widget:hover .dash-widget-bg4:before {
        transform: scale(3);
    }
    
    .dash-widget-bg1 { background: linear-gradient(45deg, #1976d2, #64b5f6); }
    .dash-widget-bg2 { background: linear-gradient(45deg, #43a047, #81c784); }
    .dash-widget-bg3 { background: linear-gradient(45deg, #e53935, #ef5350); }
    .dash-widget-bg4 { background: linear-gradient(45deg, #fb8c00, #ffb74d); }
    
    .dash-widget-info h3 {
        font-size: 2.5rem;
        font-weight: 700;
        margin-bottom: 5px;
        color: #333;
        animation: countUp 2s ease-out;
    }
    
    @keyframes countUp {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    .widget-title1, .widget-title2, .widget-title3, .widget-title4 {
        font-weight: 600;
        color: #555;
        position: relative;
        padding-bottom: 5px;
    }
    
    .widget-title1:after, .widget-title2:after, .widget-title3:after, .widget-title4:after {
        content: '';
        position: absolute;
        bottom: 0;
        right: 0;
        width: 0;
        height: 2px;
        transition: width 0.5s ease;
    }
    
    .dash-widget:hover .widget-title1:after, 
    .dash-widget:hover .widget-title2:after, 
    .dash-widget:hover .widget-title3:after, 
    .dash-widget:hover .widget-title4:after {
        width: 100%;
    }
    
    .widget-title1:after { background: #1976d2; }
    .widget-title2:after { background: #43a047; }
    .widget-title3:after { background: #e53935; }
    .widget-title4:after { background: #fb8c00; }
    
    .card {
        border-radius: 10px;
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.08);
        transition: all 0.3s ease;
        overflow: hidden;
    }
    
    .card:hover {
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.15);
    }
    
    .card-header {
        border-bottom: none;
        position: relative;
        padding: 20px;
    }
    
    .card-header:after {
        content: '';
        position: absolute;
        bottom: 0;
        left: 20px;
        right: 20px;
        height: 2px;
        background: linear-gradient(to right, #1976d2, transparent);
    }
    
    .card-title {
        font-weight: 600;
        color: #333;
        margin: 0;
    }
    
    .btn-primary {
        background: linear-gradient(45deg, #1976d2, #64b5f6);
        border: none;
        border-radius: 30px;
        padding: 8px 20px;
        transition: all 0.3s ease;
        box-shadow: 0 3px 10px rgba(25, 118, 210, 0.3);
    }
    
    .btn-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(25, 118, 210, 0.5);
    }
    
    .table {
        margin-bottom: 0;
    }
    
    .table tr {
        transition: all 0.3s ease;
    }
    
    .table tr:hover {
        background-color: rgba(0, 0, 0, 0.02);
        transform: scale(1.01);
    }
    
    .rounded-circle {
        box-shadow: 0 3px 10px rgba(0, 0, 0, 0.1);
        transition: all 0.3s ease;
    }
    
    .rounded-circle:hover {
        transform: scale(1.1);
    }
    
    .custom-badge {
        padding: 5px 10px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        transition: all 0.3s ease;
    }
    
    .status-red {
        background: linear-gradient(45deg, #e53935, #ef5350);
        color: white;
    }
    
    .status-green {
        background: linear-gradient(45deg, #43a047, #81c784);
        color: white;
    }
    
    .contact-list li {
        transition: all 0.3s ease;
        border-radius: 5px;
        margin-bottom: 10px;
    }
    
    .contact-list li:hover {
        background-color: rgba(0, 0, 0, 0.02);
        transform: translateX(5px);
    }
    
    .contact-name {
        font-weight: 600;
        color: #333;
    }
    
    .contact-date {
        color: #777;
        font-size: 12px;
    }
    
    .status {
        position: absolute;
        width: 10px;
        height: 10px;
        border-radius: 50%;
        bottom: 0;
        right: 0;
        border: 2px solid white;
    }
    
    .status.online {
        background-color: #43a047;
    }
    
    /* Animation for page load */
    @keyframes fadeInUp {
        from {
            opacity: 0;
            transform: translateY(20px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }
    
    .row > div {
        animation: fadeInUp 0.5s ease-out forwards;
        opacity: 0;
    }
    
    .row > div:nth-child(1) { animation-delay: 0.1s; }
    .row > div:nth-child(2) { animation-delay: 0.2s; }
    .row > div:nth-child(3) { animation-delay: 0.3s; }
    .row > div:nth-child(4) { animation-delay: 0.4s; }
    .row > div:nth-child(5) { animation-delay: 0.5s; }
</style>

<div class="page-wrapper">
    <div class="content">
        <div class="row">
            <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                <div class="dash-widget">
                    <span class="dash-widget-bg1"><i class="fa fa-stethoscope" aria-hidden="true"></i></span>
                    <?php
                    $fetch_query = mysqli_query($connection, "select count(*) as total from tbl_employee where status=1 and role=2"); 
                    $doc = mysqli_fetch_row($fetch_query);
                    ?>
                    <div class="dash-widget-info text-right">
                        <h3><?php echo $doc[0]; ?></h3>
                        <span class="widget-title1">Doctors <i class="fa fa-check" aria-hidden="true"></i></span>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                <div class="dash-widget">
                    <span class="dash-widget-bg2"><i class="fa fa-user-o"></i></span>
                    <?php
                    $fetch_query = mysqli_query($connection, "select count(*) as total from tbl_patient where status=1"); 
                    $patient = mysqli_fetch_row($fetch_query);
                    ?>
                    <div class="dash-widget-info text-right">
                        <h3><?php echo $patient[0]; ?></h3>
                        <span class="widget-title2">Patients <i class="fa fa-check" aria-hidden="true"></i></span>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                <div class="dash-widget">
                    <span class="dash-widget-bg3"><i class="fa fa-user-md" aria-hidden="true"></i></span>
                    <?php
                    $fetch_query = mysqli_query($connection, "select count(*) as total from tbl_appointment where status=1"); 
                    $attend = mysqli_fetch_row($fetch_query);
                    ?>
                    <div class="dash-widget-info text-right">
                        <h3><?php echo $attend[0]; ?></h3>
                        <span class="widget-title3">Attend <i class="fa fa-check" aria-hidden="true"></i></span>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                <div class="dash-widget">
                    <span class="dash-widget-bg4"><i class="fa fa-heartbeat" aria-hidden="true"></i></span>
                    <?php
                    $fetch_query = mysqli_query($connection, "select count(*) as total from tbl_patient where patient_type='OutPatient' and status=1"); 
                    $outpatient = mysqli_fetch_row($fetch_query);
                    ?>
                    <div class="dash-widget-info text-right">
                        <h3><?php echo $outpatient[0]; ?></h3>
                        <span class="widget-title4">Out Patients <i class="fa fa-check" aria-hidden="true"></i></span>
                    </div>
                </div>
            </div>
            <div class="col-md-6 col-sm-6 col-lg-6 col-xl-3">
                <div class="dash-widget">
                    <span class="dash-widget-bg4"><i class="fa fa-heartbeat" aria-hidden="true"></i></span>
                    <?php
                    $fetch_query = mysqli_query($connection, "select count(*) as total from tbl_patient where patient_type='InPatient' and status=1"); 
                    $inpatient = mysqli_fetch_row($fetch_query);
                    ?>
                    <div class="dash-widget-info text-right">
                        <h3><?php echo $inpatient[0]; ?></h3>
                        <span class="widget-title4">In Patients <i class="fa fa-check" aria-hidden="true"></i></span>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="row">
            <div class="col-12 col-md-6 col-lg-8 col-xl-8">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title d-inline-block">New Patients </h4> <a href="patients.php" class="btn btn-primary float-right">View all</a>
                    </div>
                    <div class="card-block">
                        <div class="table-responsive">
                            <table class="table mb-0 new-patient-table">
                                <tbody>
                                    <?php 
                                    $fetch_query = mysqli_query($connection, "select * from tbl_patient limit 5");
                                    while($row = mysqli_fetch_array($fetch_query))
                                    { ?>
                                    <tr>
                                        <td>
                                            <img width="28" height="28" class="rounded-circle" src="assets/img/user.jpg" alt=""> 
                                            <h2><?php echo $row['first_name']." ".$row['last_name']; ?></h2>
                                        </td>
                                        <td><?php echo $row['email']; ?></td>
                                        <td><?php echo $row['phone']; ?></td>
                                        <?php if($row['patient_type']=="InPatient") { ?>
                                            <td><span class="custom-badge status-red"><?php echo $row['patient_type']; ?></span></td>
                                        <?php } else {?>
                                            <td><span class="custom-badge status-green"><?php echo $row['patient_type']; ?></span></td>
                                        <?php } ?>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-12 col-md-6 col-lg-4 col-xl-4">
                <div class="card member-panel">
                    <div class="card-header bg-white">
                        <h4 class="card-title mb-0">Doctors</h4>
                    </div>
                    <div class="card-body">
                        <ul class="contact-list">
                            <?php 
                            $fetch_query = mysqli_query($connection, "select * from tbl_employee where status=1 and role=2 limit 5");
                            while($row = mysqli_fetch_array($fetch_query))
                            {
                            ?>
                            <li>
                                <div class="contact-cont">
                                    <div class="float-left user-img m-r-10">
                                        <a href="profile.html" title="<?php echo $row['first_name']." ".$row['last_name']; ?>">
                                            <img src="assets/img/user.jpg" alt="" class="w-40 rounded-circle">
                                            <span class="status online"></span>
                                        </a>
                                    </div>
                                    <div class="contact-info">
                                        <span class="contact-name text-ellipsis"><?php echo $row['first_name']." ".$row['last_name']; ?></span>
                                        <span class="contact-date"><?php echo $row['bio']; ?></span>
                                    </div>
                                </div>
                            </li>
                            <?php } ?>
                        </ul>
                    </div>
                    <div class="card-footer text-center bg-white">
                        <a href="doctors.php" class="text-muted">View all Doctors</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Add floating background elements for visual appeal -->
<div class="floating-bg">
    <div></div>
    <div></div>
    <div></div>
    <div></div>
    <div></div>
</div>

<script>
// Animation for counter numbers
document.addEventListener('DOMContentLoaded', function() {
    // Animate count up for dashboard numbers
    const counters = document.querySelectorAll('.dash-widget-info h3');
    
    counters.forEach(counter => {
        const target = parseInt(counter.innerText);
        const duration = 2000; // 2 seconds
        const step = Math.ceil(target / (duration / 50)); // Update every 50ms
        let current = 0;
        
        const updateCounter = () => {
            current += step;
            if (current > target) current = target;
            counter.innerText = current;
            
            if (current < target) {
                setTimeout(updateCounter, 50);
            }
        };
        
        // Start with 0
        counter.innerText = '0';
        // Begin animation after a small delay
        setTimeout(updateCounter, 300);
    });
    
    // Add hover effects to table rows
    const tableRows = document.querySelectorAll('tbody tr');
    tableRows.forEach(row => {
        row.addEventListener('mouseenter', function() {
            this.style.transform = 'scale(1.01)';
            this.style.boxShadow = '0 5px 15px rgba(0,0,0,0.1)';
            this.style.zIndex = '1';
        });
        
        row.addEventListener('mouseleave', function() {
            this.style.transform = 'scale(1)';
            this.style.boxShadow = 'none';
            this.style.zIndex = '0';
        });
    });
    
    // Add floating background animation
    const floatingElements = document.querySelectorAll('.floating-bg div');
    
    floatingElements.forEach((element, index) => {
        // Set random positions
        element.style.top = Math.random() * 100 + '%';
        element.style.left = Math.random() * 100 + '%';
        element.style.width = (Math.random() * 100 + 50) + 'px';
        element.style.height = (Math.random() * 100 + 50) + 'px';
        element.style.animationDelay = (index * 0.5) + 's';
        element.style.animationDuration = (Math.random() * 5 + 5) + 's';
    });
});
</script>

<style>
/* Additional floating background animation */
.floating-bg {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    z-index: -1;
    overflow: hidden;
    pointer-events: none;
}

.floating-bg div {
    position: absolute;
    border-radius: 50%;
    background: linear-gradient(45deg, rgba(25, 118, 210, 0.1), rgba(100, 181, 246, 0.1));
    animation: float 15s infinite ease-in-out;
}

@keyframes float {
    0% {
        transform: translate(0, 0) rotate(0deg) scale(1);
    }
    25% {
        transform: translate(50px, 50px) rotate(90deg) scale(1.1);
    }
    50% {
        transform: translate(0, 100px) rotate(180deg) scale(1);
    }
    75% {
        transform: translate(-50px, 50px) rotate(270deg) scale(0.9);
    }
    100% {
        transform: translate(0, 0) rotate(360deg) scale(1);
    }
}

/* Pulse animation for important elements */
@keyframes pulse {
    0% {
        box-shadow: 0 0 0 0 rgba(25, 118, 210, 0.4);
    }
    70% {
        box-shadow: 0 0 0 10px rgba(25, 118, 210, 0);
    }
    100% {
        box-shadow: 0 0 0 0 rgba(25, 118, 210, 0);
    }
}

.btn-primary {
    animation: pulse 2s infinite;
}

/* Enhance card transitions */
.card {
    position: relative;
    overflow: hidden;
}

.card::before {
    content: '';
    position: absolute;
    top: 0;
    left: -100%;
    width: 100%;
    height: 100%;
    background: linear-gradient(90deg, transparent, rgba(255, 255, 255, 0.2), transparent);
    transition: 0.5s;
}

.card:hover::before {
    left: 100%;
}
</style>

<?php 
include('footer.php');
?>

