@extends('layouts.account')

@section('title', 'Order History | Star Tech')

@section('breadcrumb_extra')
    <i class="fas fa-chevron-right"></i>
    <span>Order History</span>
@endsection

@section('account_content')
<div class="account-content">
    <h2>Order History</h2>
    
    <div style="overflow-x: auto;">
        <table class="account-table">
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>Customer</th>
                    <th>No. of Products</th>
                    <th>Status</th>
                    <th>Total</th>
                    <th>Date Added</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td colspan="7" style="text-align: center; padding: 30px; color: #666;">You have not made any previous orders!</td>
                </tr>
            </tbody>
        </table>
    </div>

    <div style="margin-top: 30px;">
        <a href="{{ url('/account/account') }}" class="btn-continue" style="text-decoration: none; display: inline-block;">Continue</a>
    </div>
</div>
@endsection
