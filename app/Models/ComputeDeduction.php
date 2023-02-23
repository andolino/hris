<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ComputeDeduction extends Model
{
    use HasFactory;
    
    protected static $salary;
    protected static $sss;
    protected static $philhealth;
    protected static $pagibig;
    protected static $totalDeductions;
    protected static $totalContributions;
    protected static $incomeTax;
    protected static $netPay;
    protected static $contributions;
    protected static $taxableIncome;
    protected static $salaryAfterTax;
    
    public static function sanitize($value){
        return floatval(str_replace(',','',$value));
    }
    
    public static function format($value){
        return number_format($value, 2);
    }
    
    public static function compute($salary){
    
        self::setSSS();
        self::setPhilHealth();
        self::setPagIBIG();
        self::compTotalContributions();
    
        self::$taxableIncome = self::sanitize(self::$salary) - self::compTotalContributions();//self::sanitize(self::contributions);
        
        if(self::$taxableIncome <= 20833){
    
        self::$incomeTax = 0;//`â‚± 0 - ${"Tax Exempted"}`;
        self::$salaryAfterTax = self::format((self::$salary - self::sanitize(self::$incomeTax)));
    
        } else if(self::$taxableIncome >= 20833 && self::$taxableIncome <= 33332){
    
        if(self::$taxableIncome > 20833){
    
            self::$incomeTax  = self::format(((self::$taxableIncome - 20833) * 0.20));
            self::$salaryAfterTax = self::format((self::$salary - self::sanitize(self::$incomeTax)));
    
        } else {
    
            self::$incomeTax  = self::format((0));
            self::$salaryAfterTax = self::format((self::$salary - self::sanitize(self::$incomeTax)));
    
        }
    
        } else if(self::$taxableIncome >= 33333 && self::$taxableIncome <= 66666){
    
        if(self::$taxableIncome > 33333){
    
            self::$incomeTax  = self::format((((self::$taxableIncome - 33333) * 0.25) + 2500));
            self::$salaryAfterTax = self::format((self::$salary - self::sanitize(self::$incomeTax)));
    
        } else {
    
            self::$incomeTax  = self::format((2500));
            self::$salaryAfterTax = self::format((self::$salary - self::sanitize(self::$incomeTax)));
    
        }
    
        } else if(self::$taxableIncome >= 66667 && self::$taxableIncome <= 166666){
    
        if(self::$taxableIncome > 66667){
    
            self::$incomeTax  = self::format((((self::$taxableIncome - 66667) * 0.30) + 10833.33));
            self::$salaryAfterTax = self::format((self::$salary - self::sanitize(self::$incomeTax)));
    
        } else {
    
            self::$incomeTax  = self::format((10833.33));
            self::$salaryAfterTax = self::format((self::$salary - self::sanitize(self::$incomeTax)));
    
        }
    
        } else if(self::$taxableIncome >= 166667 && self::$taxableIncome <= 666666){
    
        if(self::$taxableIncome > 166667){
    
            self::$incomeTax  = self::format((((self::$taxableIncome - 166667) * 0.32) + 40833.33));
            self::$salaryAfterTax = self::format((self::$salary - self::sanitize(self::$incomeTax)));
    
        } else {
    
            self::$incomeTax  = self::format((40833.33));
            self::$salaryAfterTax = self::format((self::$salary - self::sanitize(self::$incomeTax)));
    
        }
    
        } else if(self::$taxableIncome >= 666667){
    
        if(self::$taxableIncome > 666667){
    
            self::$incomeTax  = self::format((((self::$taxableIncome - 666667) * 0.35) + 200833.33));
            self::$salaryAfterTax = self::format((self::$salary - self::sanitize(self::$incomeTax)));
    
        } else {
    
            self::$incomeTax  = self::format((200833.33));
            self::$salaryAfterTax = self::format((self::$salary - self::sanitize(self::$incomeTax)));
    
        }
    
        }
        self::compTotalDeductions();
        self::totalNetPay();
    }

    public static function setSSS(){
        // $table = [
        //     [1000,3249.99,135],
        //     [3250,3749.99,157.50],
        //     [3750,4249.99,180],
        //     [4250,4749.99,202.5],
        //     [4750,5249.99,225],
        //     [5250,5749.99,247.5],
        //     [5750,6249.99,270],
        //     [6250,6749.99,292.5],
        //     [6750,7249.99,315],
        //     [7250,7749.99,337.5],
        //     [7750,8249.99,360],
        //     [8250,8749.99,382.5],
        //     [8750,9249.99,405],
        //     [9250,9749.99,427.5],
        //     [9750,10249.99,450],
        //     [10250,10749.99,472.5],
        //     [10750,11249.99,495],
        //     [11250,11749.99,517.5],
        //     [11750,12249.99,540],
        //     [12250,12749.99,562.5],
        //     [12750,13249.99,585],
        //     [13250,13749.99,607.5],
        //     [13750,14249.99,630],
        //     [14250,14749.99,652.5],
        //     [14750,15249.99,675],
        //     [15250,15749.99,697.5],
        //     [15750,16249.99,720],
        //     [16250,16749.99,742.5],
        //     [16750,17249.99,765],
        //     [17250,17749.99,787.5],
        //     [17750,18249.99,810],
        //     [18250,18749.99,832.5],
        //     [18750,19249.99,855],
        //     [19250,19749.99,877.5],
        //     [19750,20249.99,900],
        //     [20250,20749.99,922.5],
        //     [20750,21249.99,945],
        //     [21250,21749.99,967.5],
        //     [21750,22249.99,990],
        //     [22250,22749.99,1012.5],
        //     [22270,23249.99,1035],
        //     [23250,23749.99,1057.5],
        //     [23750,24249.99,1080],
        //     [24250,24279.99,1102.5],
        //     [24750,1125],
        // ];

        $table = [
            [1000,4249.99,180],
            [4250,4749.99,202.50],
            [4750,5249.99,225],
            [5250,5749.99,247.5],
            [5750,6249.99,270],
            [6250,6749.99,292.5],
            [6750,7249.99,315],
            [7250,7749.99,337.5],
            [7750,8249.99,360],
            [8250,8749.99,382.5],
            [8750,9249.99,405],
            [9250,9749.99,427.5],
            [9750,10249.99,450],
            [10250,10749.99,472.5],
            [10750,11249.99,495],
            [11250,11749.99,517.5],
            [11750,12249.99,540],
            [12250,12749.99,562.5],
            [12750,13249.99,585],
            [13250,13749.99,607.5],
            [13750,14249.99,630],
            [14250,14749.99,652.5],
            [14750,15249.99,675],
            [15250,15749.99,697.5],
            [15750,16249.99,720],
            [16250,16749.99,742.5],
            [17750,17249.99,765],
            [17250,17749.99,787.5],
            [17750,18249.99,810],
            [18250,18749.99,832],
            [18750,19249.99,855],
            [19250,19749.99,877.5],
            [19750,20249.99,900],
            [20250,20749.99,922.5],
            [20750,21249.99,945],
            [21250,21749.99,967.5],
            [21750,22249.99,990],
            [22250,22749.99,1012.5],
            [22750,23249.99,1035],
            [23250,23749.99,1057.5],
            [23750,24249.99,1080],
            [24250,24749.99,1102.5],
            [24750,25249.99,1125],
            [25250,25749.99,1147.5],
            [26750,26249.99,1170],
            [26250,26749.99,1192.5],
            [26750,27249.99,1215],
            [27250,27749.99,1237.5],
            [27750,28249.99,1260],
            [28250,28749.99,1282.5],
            [28750,29249.99,1305],
            [29250,29749.99,1327.5],
            [29750,1350],
        ];
    
        for($i = 0; $i < count($table); $i++){
    
        if($i == count($table) - 1){
            if (self::$salary >= $table[$i][0]){
            // self::$sss = self::format((1125));
            self::$sss = self::format((1350));
            break;
            }
        }
    
        if(self::$salary >= $table[$i][0] && self::$salary <= $table[$i][1]){
            self::$sss = self::format(($table[$i][2]));
            break;
        }
        }
        
    }
    
    public static function getSSS(){
        return self::$sss;
    }
    
    public static function setPhilHealth(){
        if(self::$salary <= 10000){
        self::$philhealth = self::format((300));
        } else if (self::$salary >= 10000.01 && self::$salary <= 59999.99){
        //old computation
        // self::$philhealth = self::format(((self::$salary * 0.03) / 2));
        //new computation
        self::$philhealth = self::format(((self::$salary * 0.04) / 2));
        } else if (self::$salary >= 60000){
        self::$philhealth = self::format((1800));
        }
    }
    
    public static function getPhilHealth(){
        return self::$philhealth;
    }

    public static function setPagIBIG(){
        if(self::$salary <= 1500){
        self::$pagibig = self::format((self::$salary * 0.01));
        } else if (self::$salary > 1500 && self::$salary < 5000){
        self::$pagibig = self::format((self::$salary * 0.02));
        } else if (self::$salary >= 5000){
        self::$pagibig = self::format((100));
        }
    }

    public static function getPagIBIG(){
        return self::$pagibig;
    }

    public static function compTotalContributions(){
        return self::sanitize(self::getSSS()) + self::sanitize(self::getPhilHealth()) + self::sanitize(self::getPagIBIG());
    }

    public static function compTotalDeductions(){
        self::$totalDeductions = self::format(self::sanitize(self::$incomeTax) + self::sanitize(self::compTotalContributions()));
    }
    
    public static function totalNetPay(){
        self::$netPay = self::format((self::sanitize(self::$salary) - self::sanitize(self::$totalDeductions)));
    }

    public static function showComputation($slry){
        self::$salary=$slry;
        self::compute(self::$salary);
        return [
        'sss'=>self::$sss,
        'philhealth'=>self::$philhealth,
        'pagibig'=>self::$pagibig,
        'totalContributions'=>self::compTotalContributions(),//self::compTotalContributions(),
        'incomeTax'=>self::$incomeTax,
        'salaryAfterTax'=>self::$salaryAfterTax,
        'totalDeductions'=>self::$totalDeductions,
        'totalNetPay' => self::$netPay,
        ];
    }


}
