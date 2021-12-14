<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <title>PDF Report</title>

    <!-- Styles -->
    <style>
    .report-wrapper {
        display: flex;
        width: 100%;
        align-items: center;
        justify-content: center;
        border-width: 1px;
        border-style: dashed;
        opacity: 1;
        border-color: rgba(28, 130, 0, 1);
        padding: 2.5rem;
    }

    .report-wrapper .report {
        display: flex;
        width: 66.666667%;
        flex-direction: column;
        opacity: 1;
        background-color: rgba(255, 255, 255, 1);
        padding: 2.5rem;
        /* box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1), 0 4px 6px -2px rgba(0, 0, 0, 0.05); */
        /* box-shadow: var(--tw-ring-offset-shadow, 0 0 #0000), var(--tw-ring-shadow, 0 0 #0000), var(--tw-shadow); */
    }

    .report-wrapper .report .reporthead {
        display: flex;
        align-items: center;
        justify-content: space-between;
        border-bottom-width: 1px;
        opacity: 1;
        border-color: rgba(107, 114, 128, 1);
        padding-bottom: 0.75rem;
    }

    .report-wrapper .report .reporthead h1 {
        width: 33.333333%;
        font-size: 1.125rem;
        line-height: 1.75rem;
        font-weight: 600;
    }

    .report-wrapper .report .reporthead h2 {
        width: 33.333333%;
        font-size: 1.125rem;
        line-height: 1.75rem;
        font-weight: 600;
    }

    .report-wrapper .report .reporthead span {
        width: 33.333333%;
        font-size: 1.125rem;
        line-height: 1.75rem;
    }

    .report-wrapper .report .report-items {
        margin-top: 1.25rem;
        display: flex;
        flex-direction: column;
    }

    .report-wrapper .report .report-items .report-item:not(:last-child) {
        margin-bottom: 1.25rem;
    }

    .report-wrapper .report .report-items .report-item .report-item-serial {
        position: relative;
        top: 0px;
        left: 0px;
        opacity: 1;
        background-color: rgba(31, 41, 55, 1);
        padding: 0.75rem;
        opacity: 1;
        color: rgba(255, 255, 255, 1);
    }

    .report-wrapper .report .report-items .report-item .report-data {
        border-width: 2px;
        opacity: 1;
        border-color: rgba(31, 41, 55, 1);
    }

    .report-wrapper .report .report-items .report-item .report-data .details {
        display: flex;
        padding: 0.75rem;
    }

    .report-wrapper .report .report-items .report-item .report-data .details .detail {
        display: flex;
        width: 33.333333%;
        flex-direction: column;
    }

    .report-wrapper .report .report-items .report-item .report-data .details .detail p.label {
        font-weight: 600;
    }

    .report-wrapper .report .report-items .report-item .report-data .details .detail p.value {
        opacity: 1;
        color: rgba(31, 41, 55, 1);
    }

    .report-wrapper .report .report-items .report-item .report-data .details .detail:not(:last-child) {
        margin-bottom: 0.5rem;
    }
    </style>

    <!-- Scripts -->
</head>

<body>


    <main>
        @yield('report')
    </main>

</body>

</html>