@extends('layouts.mail')

@section('mail-bg')
    <table cellpadding="0"
           cellspacing="0"
           role="presentation"
           width="100%">
        <tr>
            <td class="col"
                align="center"
                bgcolor="#ffffff"
                width="100%">
                <img src="https://cdn.flexipim.com/email/background-image/feedback.jpg"
                     style="background-repeat: no-repeat;
                                        background-position: center;
                                        background-size: cover;
                                        width: 100%;
                                        height: auto">
            </td>
        </tr>
    </table>
@endsection

@section('username')
    <h2 class="title"
        style="color: #3c3f59;
            font-size: 28px;
            margin-top: 0;
            line-height: 1.4;">
        Hi Jhon
    </h2>
@endsection

@section('content')
    <table cellpadding="0"
           cellspacing="0"
           role="presentation"
           width="100%">
        <tr>
            <td style="padding: 0 24px;" class="p-sm-0">
                <table cellpadding="0"
                       cellspacing="0"
                       role="presentation"
                       width="100%">
                    <tr>
                        <td class="col" align="center" width="100%">
                            <p class="title"
                               style="  color: #6d6d88;
                                                        font-size: 17px;
                                                        margin-top: 0;
                                                        line-height: 1.4;">
                                Hope you have a great experience using flexiPIM. As always, we evolve to give the best
                                product to your users.
                                We look forward to hearing the feedback from you. Any suggestions and comments are
                                welcome.
                            </p>
                        </td>
                    </tr>
                    <tr>
                        <td class="spacer py-sm-16" height="32"></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
@endsection


