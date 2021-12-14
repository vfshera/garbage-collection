@extends('layouts.pdf')

@section('report')
<x-order-report-view :reportType="$reportType" :orders="$orders" />
@endsection