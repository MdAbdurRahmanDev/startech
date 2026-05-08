@extends('layouts.account')

@section('title', 'Edit Information | Star Tech')

@section('breadcrumb_extra')
    <i class="fas fa-chevron-right"></i>
    <span>Edit Information</span>
@endsection

@section('account_content')
<div class="account-content">
    <h2>My Account Information</h2>
    
    <form action="#" method="POST">
        @csrf
        <div style="display: grid; grid-template-columns: 1fr 1fr; gap: 20px;">
            <div class="form-group">
                <label for="firstname">First Name <span class="required">*</span></label>
                <input type="text" id="firstname" name="firstname" value="Rahman" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="lastname">Last Name <span class="required">*</span></label>
                <input type="text" id="lastname" name="lastname" value="Miah" class="form-control" required>
            </div>
        </div>

        <div class="form-group">
            <label for="email">E-Mail <span class="required">*</span></label>
            <input type="email" id="email" name="email" value="mdrahmanmiah2003@gmail.com" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="telephone">Telephone <span class="required">*</span></label>
            <input type="tel" id="telephone" name="telephone" value="01576616323" class="form-control" required>
        </div>

        <div class="form-group">
            <label for="fax">Fax</label>
            <input type="text" id="fax" name="fax" placeholder="Fax" class="form-control">
        </div>

        <div style="margin-top: 30px;">
            <button type="submit" class="btn-continue">Continue</button>
        </div>
    </form>
</div>
@endsection
