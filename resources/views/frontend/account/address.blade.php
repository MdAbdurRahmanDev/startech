@extends('layouts.account')

@section('title', 'Address Book | Star Tech')

@section('breadcrumb_extra')
    <i class="fas fa-chevron-right"></i>
    <span>Address Book</span>
@endsection

@section('account_content')
<div class="account-content">
    <h2>Address Book Entries</h2>
    
    <div style="border: 1px solid #eee; border-radius: 4px; padding: 20px; margin-bottom: 30px;">
        <table style="width: 100%;">
            <tr>
                <td style="font-size: 14px; line-height: 1.6;">
                    <strong>Rahman Miah</strong><br>
                    Dhaka, Bangladesh
                </td>
                <td style="text-align: right;">
                    <a href="#" class="btn-continue" style="background: var(--accent-orange); padding: 8px 20px; text-decoration: none; font-size: 13px;">Edit</a>
                    <a href="#" class="btn-continue" style="background: #666; padding: 8px 20px; text-decoration: none; font-size: 13px;">Delete</a>
                </td>
            </tr>
        </table>
    </div>

    <div style="display: flex; justify-content: space-between; align-items: center;">
        <a href="{{ url('/account/account') }}" class="btn-continue" style="background: #666; text-decoration: none;">Back</a>
        <a href="#" class="btn-continue" style="text-decoration: none;">New Address</a>
    </div>
</div>
@endsection
