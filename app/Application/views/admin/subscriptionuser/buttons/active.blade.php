<?php
$activation = checkSubscriptionActive($id);
?>
@if($activation)
    <label class="btn btn-success">Active</label>
@else
    <label class="btn btn-danger">Expired</label>
@endif