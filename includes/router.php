<?php
switch($_SERVER['HTTP_HOST']){
    case 'dbftojson.com':
    case 'dbf2json.com':
        $site = 'DBF_To_JSON';
        break;
    case 'dbftoxml.com':
    case 'dbf2xml.com':
        $site = 'DBF_To_XML';
        break;
    case 'dbftocsv.com':
    case 'dbf2csv.com':
        $site = 'DBF_To_CSV';
        break;
    case 'dbftoxlsx.com':
    case 'dbf2xlsx.com':
        $site = 'DBF_To_XLSX';
        break;
    case 'dbftohtml.com':
    case 'dbf2html.com':
        $site = 'DBF_To_HTML';
        break;
    case 'timisim.com':
        $site = 'Timisim';
        break;
    case 'dbfto.com':
    case 'dbf2.com':
    default:
        $site = 'DBF_To';
        break;
}