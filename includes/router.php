<?php
switch($_SERVER['HTTP_HOST']){
    case 'dbftojson.com':
        $site = 'DBF_To_JSON';
        break;
    case 'dbftoxml.com':
        $site = 'DBF_To_XML';
        break;
    case 'dbftocsv.com':
        $site = 'DBF_To_CSV';
        break;
    case 'dbftoxlsx.com':
        $site = 'DBF_To_XLSX';
        break;
    case 'dbftohtml.com':
        $site = 'DBF_To_HTML';
        break;
    case 'dbfto.com':
    default:
        $site = 'DBF_To';
        break;
}