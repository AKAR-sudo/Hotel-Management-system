<?php
session_start();
if(empty($_SESSION['name'])){
    header('location:index.php');
}
include('header.php');
include('includes/connection.php');
?>
<style>
    .page-wrapper {
        background: linear-gradient(135deg, #f5f7fa 0%, #e4e8f0 100%);
        min-height: 100vh;
    }
    
    .content {
        padding: 30px;
        border-radius: 10px;
        box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        background: #fff;
        animation: fadeIn 0.8s ease-in-out;
    }
    
    @keyframes fadeIn {
        from { opacity: 0; transform: translateY(20px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    .page-title {
        font-weight: 700;
        color: #2c3e50;
        position: relative;
        padding-bottom: 10px;
    }
    
    .page-title:after {
        content: '';
        position: absolute;
        width: 50px;
        height: 3px;
        background: #3498db;
        bottom: 0;
        left: 0;
        border-radius: 10px;
    }
    
    .btn-primary {
        background: linear-gradient(45deg, #3498db, #2980b9);
        border: none;
        box-shadow: 0 4px 15px rgba(52, 152, 219, 0.4);
        transition: all 0.3s ease;
    }
    
    .btn-primary:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 20px rgba(52, 152, 219, 0.6);
    }
    
    .table {
        border-collapse: separate;
        border-spacing: 0 10px;
    }
    
    .table thead th {
        border-bottom: none;
        color: #3498db;
        font-weight: 600;
        text-transform: uppercase;
        font-size: 0.85rem;
        letter-spacing: 1px;
    }
    
    .table tbody tr {
        box-shadow: 0 2px 10px rgba(0, 0, 0, 0.05);
        border-radius: 8px;
        overflow: hidden;
        transition: all 0.3s ease;
        animation: slideIn 0.5s ease-out forwards;
        opacity: 0;
    }
    
    .table tbody tr:hover {
        transform: translateY(-5px);
        box-shadow: 0 8px 15px rgba(0, 0, 0, 0.1);
        background: #f8f9fa;
    }
    
    @keyframes slideIn {
        from { opacity: 0; transform: translateX(-20px); }
        to { opacity: 1; transform: translateX(0); }
    }
    
    .table td {
        border-top: none;
        padding: 15px;
        vertical-align: middle;
    }
    
    .dropdown-action .dropdown-menu {
        border-radius: 8px;
        box-shadow: 0 5px 25px rgba(0, 0, 0, 0.1);
        border: none;
        animation: fadeInMenu 0.3s ease;
    }
    
    @keyframes fadeInMenu {
        from { opacity: 0; transform: translateY(10px); }
        to { opacity: 1; transform: translateY(0); }
    }
    
    .dropdown-item {
        padding: 10px 20px;
        transition: all 0.2s ease;
    }
    
    .dropdown-item:hover {
        background: #f1f5f9;
        color: #3498db;
    }
    
    .action-icon {
        width: 35px;
        height: 35px;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        border-radius: 50%;
        background: #f1f5f9;
        color: #3498db;
        transition: all 0.3s ease;
    }
    
    .action-icon:hover {
        background: #3498db;
        color: white;
    }
    
    .custom-badge {
        padding: 5px 12px;
        border-radius: 20px;
        font-size: 12px;
        font-weight: 600;
        letter-spacing: 0.5px;
        text-transform: uppercase;
        display: inline-block;
        transition: all 0.3s ease;
    }
    
    .status-red {
        background: linear-gradient(45deg, #ff6b6b, #ee5253);
        color: white;
        box-shadow: 0 4px 10px rgba(238, 82, 83, 0.3);
    }
    
    .status-green {
        background: linear-gradient(45deg, #1dd1a1, #10ac84);
        color: white;
        box-shadow: 0 4px 10px rgba(16, 172, 132, 0.3);
    }
    
    .custom-badge:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 15px rgba(0, 0, 0, 0.2);
    }
    
    /* Apply animation delay to each row */
    .table tbody tr:nth-child(1) { animation-delay: 0.1s; }
    .table tbody tr:nth-child(2) { animation-delay: 0.2s; }
    .table tbody tr:nth-child(3) { animation-delay: 0.3s; }
    .table tbody tr:nth-child(4) { animation-delay: 0.4s; }
    .table tbody tr:nth-child(5) { animation-delay: 0.5s; }
    .table tbody tr:nth-child(n+6) { animation-delay: 0.6s; }
</style>

<div class="page-wrapper">
    <div class="content">
        <div class="row">
            <div class="col-sm-4 col-3">
                <h4 class="page-title">Patients</h4>
            </div>
            <div class="col-sm-8 col-9 text-right m-b-20">
                <a href="add-patient.php" class="btn btn-primary btn-rounded float-right">
                    <i class="fa fa-plus"></i> Add Patient
                </a>
            </div>
        </div>
        <div class="table-responsive">
            <table class="datatable table table-stripped">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Age</th>
                        <th>Address</th>
                        <th>Email</th>
                        <th>Phone</th>
                        <th>Category</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    if(isset($_GET['ids'])){
                        $id = $_GET['ids'];
                        $delete_query = mysqli_query($connection, "delete from tbl_patient where id='$id'");
                    }
                    $fetch_query = mysqli_query($connection, "select * from tbl_patient");
                    while($row = mysqli_fetch_array($fetch_query))
                    {
                        $dob = $row['dob'];
                        $date = str_replace('/', '-', $dob);
                        $dob = date('Y-m-d', strtotime($date));
                        $year = (date('Y') - date('Y',strtotime($dob)));
                    ?>
                    <tr>
                        <td><?php echo $row['first_name']." ".$row['last_name']; ?></td>
                        <td><?php echo $year; ?></td>
                        <td><?php echo $row['address']; ?></td>
                        <td><?php echo $row['email']; ?></td>
                        <td><?php echo $row['phone']; ?></td>
                        <?php if($row['patient_type']=="InPatient") { ?>
                            <td><span class="custom-badge status-red"><?php echo $row['patient_type']; ?></span></td>
                        <?php } else {?>
                            <td><span class="custom-badge status-green"><?php echo $row['patient_type']; ?></span></td>
                        <?php } ?>
                        <td class="text-right">
                            <div class="dropdown dropdown-action">
                                <a href="#" class="action-icon dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                    <i class="fa fa-ellipsis-v"></i>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="edit-patient.php?id=<?php echo $row['id'];?>">
                                        <i class="fa fa-pencil m-r-5"></i> Edit
                                    </a>
                                    <a class="dropdown-item" href="patients.php?ids=<?php echo $row['id'];?>" onclick="return confirmDelete()">
                                        <i class="fa fa-trash-o m-r-5"></i> Delete
                                    </a>
                                </div>
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php
include('footer.php');
?>
<script language="JavaScript" type="text/javascript">
function confirmDelete(){
    return Swal.fire({
        title: 'Are you sure?',
        text: "You won't be able to revert this patient data!",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3498db',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Yes, delete it!',
        cancelButtonText: 'Cancel',
        backdrop: `rgba(0,0,123,0.4)`,
        animation: true
    }).then((result) => {
        if (result.isConfirmed) {
            return true;
        } else {
            return false;
        }
    });
}

// Add animation class to each row with delay
document.addEventListener('DOMContentLoaded', function() {
    const tableRows = document.querySelectorAll('.table tbody tr');
    tableRows.forEach((row, index) => {
        setTimeout(() => {
            row.style.opacity = '1';
        }, 100 * (index + 1));
    });
});
</script>
