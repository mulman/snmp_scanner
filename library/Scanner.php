<?php

/**
 * Scanner is a class for scanning printers
 *
 * @author Marek Ulman
 * @copyright Copyright (c) 2012 - Marek Ulman
 * @license http://www.gnu.org/licenses/gpl.html
 */
class Scanner 
{
    /*
     * SNMP IDs
     */   
    const SNMP_PRINTER_MESSAGE          = '.1.3.6.1.2.1.43.16.5.1.2.1.2';
    const SNMP_PRINTER_FACTORY_ID       = '.1.3.6.1.2.1.1.1.0';
    const SNMP_PRINTER_NAME             = '.1.3.6.1.2.1.1.5.0';
    const SNMP_SERIAL_NUMBER            = '.1.3.6.1.2.1.43.5.1.1.17.1';
    const SNMP_PRINTER_RUNNING_TIME     = '.1.3.6.1.2.1.1.3.0';
    const SNMP_PRINTER_VENDOR_NAME      = '.1.3.6.1.2.1.43.9.2.1.8.1.1';
    const SNMP_NUMBER_OF_PRINTED_PAPERS = '.1.3.6.1.2.1.43.10.2.1.4.1.1';
    const SNMP_PRINTER_PAGE_COUNT       = '.1.3.6.1.4.1.2001.1.1.1.1.100.1.1.1.3.1';
    const SNMP_BLACK_TONER              = '.1.3.6.1.4.1.2001.1.1.1.1.100.3.1.1.3.1';
    const SNMP_CYAN_TONER               = '.1.3.6.1.4.1.2001.1.1.1.1.100.3.1.1.3.2';
    const SNMP_MAGENTA_TONER            = '.1.3.6.1.4.1.2001.1.1.1.1.100.3.1.1.3.3';
    const SNMP_YELLOW_TONER             = '.1.3.6.1.4.1.2001.1.1.1.1.100.3.1.1.3.4';
    const SNMP_BLACK_DRUM               = '.1.3.6.1.2.1.43.11.1.1.9.1.5';
    const SNMP_CYAN_DRUM                = '.1.3.6.1.2.1.43.11.1.1.9.1.6';
    const SNMP_MAGENTA_DRUM             = '.1.3.6.1.2.1.43.11.1.1.9.1.7';
    const SNMP_YELLOW_DRUM              = '.1.3.6.1.2.1.43.11.1.1.9.1.8';
    const SNMP_BELT                     = '.1.3.6.1.2.1.43.11.1.1.9.1.9';
    const SNMP_FUSER                    = '.1.3.6.1.2.1.43.11.1.1.9.1.10';
    const SNMP_MAX_BELT                 = '.1.3.6.1.2.1.43.11.1.1.8.1.9';
    const SNMP_MAX_FUSER                = '.1.3.6.1.2.1.43.11.1.1.8.1.10';
    const SNMP_MAX_BLACK_DRUM           = '.1.3.6.1.2.1.43.11.1.1.8.1.5';
    const SNMP_MAX_CYAN_DRUM            = '.1.3.6.1.2.1.43.11.1.1.8.1.6';
    const SNMP_MAX_MAGENTA_DRUM         = '.1.3.6.1.2.1.43.11.1.1.8.1.7';
    const SNMP_MAX_YELLOW_DRUM          = '.1.3.6.1.2.1.43.11.1.1.8.1.8';

    /*
     * Max Timeout for scan
     */
    const MAX_TIMEOUT = 100000;
    
    /*
     * IP address
     */
    protected $ip = null;
    
    /*
     * Constructor
     */
    public function __construct($ip = null) 
    {
        if(!extension_loaded('snmp')) 
            throw new Exception('PHP SNMP extension is not loaded!!!');
                
        if($ip != null && is_string($ip)) $this->ip = $ip;       
    }
    
    /**
     * Function gets error message of printer
     * 
     * @return string
     */
    public function getErrorMessage()
    {
        return $this->getSNMP(self::SNMP_PRINTER_MESSAGE);
    }
    
    /**
     * Function sets IP address
     * 
    */
    public function setIP($ip)
    {
        $this->ip = $ip;
    }
    /**
     * Function returns IP address
     * 
     * @return string
     */
    public function getIP()
    {
        return $this->ip;
    }
    
    /**
     * Function gets vendor name of printer
     * 
     * @return string
     */
    public function getVendorName()
    {
        return $this->getSNMP(self::SNMP_PRINTER_VENDOR_NAME);
    }
    
    /**
     * Function gets running time
     * 
     * @sreturn string
     */
    public function getRunningTime()
    {
        return $this->getSNMP(self::SNMP_PRINTER_RUNNING_TIME);
    }
    
    /**
     * Function gets name of printer
     * 
     * @return string
     */
    public function getPrinterName()
    {
        return $this->getSNMP(self::SNMP_PRINTER_NAME);
    }
    
    /**
     * Function gets serial number of printer
     * 
     * @return string
     */
    public function getSerialNumber()
    {
        return $this->getSNMP(self::SNMP_SERIAL_NUMBER);
    }
    
    /**
     * Function returns a basic info of printer
     * 
     * @return string
     */
    public function getPrinterInfo()
    {
        return array(
            'printerName'    => $this->getPrinterName(),
            'vendorName'     => $this->getVendorName(),
            'serialNumber'   => $this->getSerialNumber(),
            'ipAddress'      => $this->getIP(),
            'runningTime'    => $this->getRunningTime(),
            'printerMessage' => $this->getErrorMessage(),
            'pageCount'      => $this->getSNMP(self::SNMP_PRINTER_PAGE_COUNT)
            );
    }
    
    /**
     * Function gets level of black toner
     * 
     * @return int
     */
    public function getBlackTonerLevel()
    {
        return (int)$this->getSNMP(self::SNMP_BLACK_TONER);
    }
    
    /**
     * Function gets level of cyan toner
     * 
     * @return int
     */
    public function getCyanTonerLevel()
    {
        return (int)$this->getSNMP(self::SNMP_CYAN_TONER);
    }
    
    /**
     * Function gets level of magenta toner
     * 
     * @return int
     */
    public function getMagentaTonerLevel()
    {
        return (int)$this->getSNMP(self::SNMP_MAGENTA_TONER);
    }
    
    /**
     * Function gets level of yellow toner
     * 
     * @return int
     */
    public function getYellowTonerLevel()
    {
        return (int)$this->getSNMP(self::SNMP_YELLOW_TONER);
    }
    
    /**
     * Function gets level of black drumkit
     * 
     * @return int
     */
    public function getBlackDrumLevel()
    {
        return (int)$this->getDrumkitPercentValue(self::SNMP_BLACK_DRUM, self::SNMP_MAX_BLACK_DRUM);
    }
    
    /**
     * Function gets level of cyan drumkit
     * 
     * @return int
     */
    public function getCyanDrumLevel()
    {
        return (int)$this->getDrumkitPercentValue(self::SNMP_CYAN_DRUM, self::SNMP_MAX_CYAN_DRUM);
    }
    
    /**
     * Function gets level of magenta drumkit
     * 
     * @return int
     */
    public function getMagentaDrumLevel()
    {
        return (int)$this->getDrumkitPercentValue(self::SNMP_MAGENTA_DRUM, self::SNMP_MAX_MAGENTA_DRUM);
    }
    
    /**
     * Function gets level of yellow drumkit
     * 
     * @return int
     */
    public function getYellowDrumLevel()
    {
        return (int)$this->getDrumkitPercentValue(self::SNMP_YELLOW_DRUM, self::SNMP_MAX_YELLOW_DRUM);
    }
    
    /**
     * Function gets level of belt
     * 
     * @return int
     */
    public function getBeltLevel()
    {
        return (int)$this->getBeltFuserPercentValue(self::SNMP_BELT, self::SNMP_MAX_BELT);
    }
    
    /**
     * Function gets level of fuser
     * 
     * @return int
     */    
    public function getFuserLevel()
    {
        return (int)$this->getBeltFuserPercentValue(self::SNMP_FUSER, self::SNMP_MAX_FUSER);
    }
    
    /**
     * Function returns drumkit level
     * 
     * @return int
     */
    private function getDrumkitPercentValue($drumObjectID,$drumMaxObjectID)
    {
        return round(($this->getSNMP($drumObjectID) / $this->getSNMP($drumMaxObjectID)) * 100);
    }
    
    /**
     * Function returns belt level
     * 
     * @return int
     */
    private function getBeltFuserPercentValue($beltFuserObjectID,$beltFuserMaxObjectID)
    {
        return 100 - round(($this->getSNMP($beltFuserObjectID) / $this->getSNMP($beltFuserMaxObjectID)) * 100);
    }
    /**
     * Function returns SNMPget
     * 
     */
    private function getSNMP($snmpID = self::SNMP_ERROR_CODE)
    {
        if($this->ip == null) throw new Exception('Ip was not defined');
        
        $snmpRespond = @snmpget($this->ip, 'public', $snmpID, self::MAX_TIMEOUT);         
        return $this->filterRespond($snmpRespond) != '' ? $this->filterRespond($snmpRespond) : '-Nothing-';
    }
    
    /**
     * Function returns filtered respond
     * 
     * @return string
     */
    private function filterRespond($respond)
    {
        $garbage = array(
            'STRING: ',
            'INTEGER: ',
            '"'
        );        
        return str_replace($garbage, '', $respond);       
    }    
}

?>
