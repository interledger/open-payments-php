<?php

namespace OpenPayments\Enums;

enum IncomingPaymentRequestAction: string
{
    case CREATE = 'create';
    case COMPLETE = 'complete';
    case READ = 'read';
    case READ_ALL = 'read-all';
    case LIST = 'list';
    case LIST_ALL = 'list-all';
}

enum IncomingPaymentAccessAction: string
{
    case CREATE = 'create';
    case COMPLETE = 'complete';
    case READ = 'read';
    case READ_ALL = 'read-all';
    case LIST = 'list';
    case LIST_ALL = 'list-all';
}


enum OutgoingPaymentRequestAction: string
{
    case CREATE = 'create';
    case READ = 'read';
    case READ_ALL = 'read-all';
    case LIST = 'list';
    case LIST_ALL = 'list-all';
}
enum OutgoingPaymentAccessAction: string
{
    case CREATE = 'create';
    case READ = 'read';
    case READ_ALL = 'read-all';
    case LIST = 'list';
    case LIST_ALL = 'list-all';
}
enum QuoteRequestAction: string
{
    case CREATE = 'create';
    case READ = 'read';
    case READ_ALL = 'read-all';
}
enum QuoteAccessAction: string
{
    case CREATE = 'create';
    case READ = 'read';
    case READ_ALL = 'read-all';
}