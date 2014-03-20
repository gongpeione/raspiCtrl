<?php
	
	$getInfo = $_GET['info'];
	if(!empty($getInfo))
	{
		switch ($getInfo) 
		{
			case 'uptime':
				getUptime();
				break;
			case 'name':
				getName();
				break;
			case 'ver':
				getVersion();
				break;
			case 'temp':
				getTemp();
				break;
			case 'memtotal':
				getMemTotal();
				break;
			case 'memused':
				getMemUsed();
				break;
			case 'memper':
				getMemPer();
				break;
			case 'swaptotal':
				getSwapTotal();
				break;
			case 'swapused':
				getSwapUsed();
				break;
			case 'swapper':
				getSwapPer();
				break;

			default:
				break;
		}
	}

	/*------------------------------------------------
	*
	*		获取运行时间
	*
	*------------------------------------------------*/
	function sec2Time($time)
    {
        if(is_numeric($time))
        {
            $value = array(
                    "days" => 0, "hours" => 0,
                    "minutes" => 0, "seconds" => 0,
            );
            if($time >= 86400)
            {
                $value["days"] = floor($time/86400);
                $time = ($time%86400);
            }
            if($time >= 3600)
            {
                $value["hours"] = floor($time/3600);
                $time = ($time%3600);
            }
            if($time >= 60)
            {
                $value["minutes"] = floor($time/60);
                $time = ($time%60);
            }
            $value["seconds"] = floor($time);
            return (array) $value;
        }
        else
        {
            return (bool) FALSE;
        }
    }

    function uptime()
    {
	    $uptime = file("/proc/uptime");
	    $uptime = explode(' ', $uptime[0]);
	    $uptime = $uptime[0];
	    $uptime = sec2Time($uptime);
	    $uptime = $uptime['days'] . '天 ' . $uptime['hours'] . '小时 ' . $uptime['minutes'] . '分钟 ' . $uptime['seconds'] . '秒 ';

	    return $uptime;
    }

    function getUptime()
    {
	    $uptime = uptime();

	    echo $uptime;
    }


    /*------------------------------------------------
	*
	*		获取主机名
	*
	*------------------------------------------------*/
	function name()
  	{
		$hostname = file('/proc/sys/kernel/hostname');
		$hostname = $hostname[0];

		return $hostname;
    }

	function getName()
  	{
		$hostname = name();

		echo $hostname;
    }



    /*------------------------------------------------
	*
	*		获取系统版本
	*
	*------------------------------------------------*/
	function version()
	{
	    $sysVer = file('/proc/version');
	    $sysVer = substr($sysVer[0],0,22);

	    return $sysVer;
	}

	function getVersion()
	{
	    $sysVer = version();

	    echo $sysVer;
	}


    /*------------------------------------------------
	*
	*		获取CPU温度
	*
	*------------------------------------------------*/
	function temp()
	{
	    $temp = file('/sys/class/thermal/thermal_zone0/temp');
	    $temp = floor($temp[0] / 1000);

	    return $temp;
	}

	function getTemp()
	{
	    $temp = temp();

	    echo $temp;
	}


    /*------------------------------------------------
	*
	*		获取内存信息
	*
	*------------------------------------------------*/
	function memInfo()
	{	
		$memory = file('/proc/meminfo');
	    
		$meminfo['total'] = str_replace('MemTotal: ', '', $memory[0] );
		$meminfo['total'] = str_replace(' kB', '', $meminfo['total'] );
		$meminfo['total'] = (int)$meminfo['total'] / 1000;
		
		$meminfo['used']     = str_replace('MemFree: ', '', $memory[1] );
		$meminfo['used']     = str_replace(' kB', '', $meminfo['used'] );
		$meminfo['used']     = (int)$meminfo['used'] / 1000;
		$meminfo['used']     = ($meminfo['total'] - $meminfo['used']);
		$meminfo['persent']  = $meminfo['used'] / $meminfo['total'];

		$meminfo['swaptotal'] = str_replace('SwapTotal: ', '', $memory[13] );
		$meminfo['swaptotal'] = str_replace(' kB', '', $meminfo['swaptotal'] );
		$meminfo['swaptotal'] = (int)$meminfo['swaptotal'] / 1000;
		
		$meminfo['swapused']     = str_replace('SwapFree: ', '', $memory[14] );
		$meminfo['swapused']     = str_replace(' kB', '', $meminfo['swapused'] );
		$meminfo['swapused']     = (int)$meminfo['swapused'] / 1000;
		$meminfo['swapused']     = ($meminfo['swapused'] - $meminfo['swapused']);
		$meminfo['swappersent']  = $meminfo['swapused'] / $meminfo['swaptotal'];

	    return $meminfo;
	}

	function getMemTotal()
	{
		$memory  = memInfo();
		$meminfo = $memory['total'];

	    echo $meminfo;
	}

	function getMemUsed()
	{
		$memory  = memInfo();
		$meminfo = $memory['used'];

	    echo $meminfo;
	}

	function getMemPer()
	{
		$memory  = memInfo();
		$meminfo = $memory['persent'] * 100;

	    echo $meminfo;
	}

	function getSwapTotal()
	{
		$memory  = memInfo();
		$meminfo = $memory['swaptotal'];

	    echo $meminfo;
	}

	function getSwapUsed()
	{
		$memory  = memInfo();
		$meminfo = $memory['swapused'];

	    echo $meminfo;
	}

	function getSwapPer()
	{
		$memory  = memInfo();
		$meminfo = $memory['swappersent'] * 100;

	    echo $meminfo;
	}