<?php

function AutoID($tableName,$fieldName,$prefix,$noOfLeadingZeros)
{
	$connect=mysqli_connect("localhost","root","","culturesneakerdb");
	$newID="";
	$sql="";
	$value=1;
	
	$sql="SELECT `$fieldName` FROM  `$tableName` ORDER BY  $fieldName DESC";	
	
	$result = mysqli_query($connect,$sql);
	$noOfRow=mysqli_num_rows($result);
	$row=mysqli_fetch_array($result);

	
	if ($noOfRow<1)
	{		//OID.
		return $prefix . "000001";
	}
	else
	{
		$oldID=$row[$fieldName];	//Reading Last ID
		$oldID=str_replace($prefix,"",$oldID);	//Removing "Prefix"  
		$value=(int)$oldID;	//Convert to Integer
		$value++;	//Increment		
		$newID=$prefix . NumberFormatter($value,$noOfLeadingZeros);			
		return $newID;		
	}
}

function AutoID_ByDate($tableName,$primaryKeyName,$dateFieldName
							,$month,$year,$noOfLeadingZeros)
{
	$newID="";
	$sql="";
	$value=1;
	$month_String=NumberFormatter($month,2);		
	
	$sql="SELECT " . $primaryKeyName . " FROM `" . $tableName . "` " .
	"WHERE MONTH($dateFieldName)=$month " .
	"AND YEAR($dateFieldName)=$year " .
	" ORDER BY " . $primaryKeyName . " DESC";	
	
	//echo "$sql";
	
	$result = mysqli_query($sql);
	$noOfRow=mysqli_num_rows($result);
	$row = mysqli_fetch_array($result);		
	
	if ($noOfRow<1)
	{		
		return $month_String . $year . "000001";
	}
	else
	{
		$oldID=$row[$primaryKeyName];	//Reading Last ID		
		$oldID=substr($oldID,6,$noOfLeadingZeros);
		$value=(int)$oldID;	//Convert to Integer
		$value++;	//Increment		
		$newID=$month_String . $year . NumberFormatter($value,$noOfLeadingZeros);		
		return $newID;		
	}
}

function NumberFormatter($number,$n) 
{	
	return str_pad((int) $number,$n,"0",STR_PAD_LEFT);
}
?>
