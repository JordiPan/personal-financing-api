<?php
namespace App\Enums;

enum Recurrence:string {
  case Once = 'once';
  case Daily = 'daily';
  case Weekly = 'weekly';
  case Monthly = 'monthly';
  case Yearly = 'yearly';
}