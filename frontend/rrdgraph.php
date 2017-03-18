<?php

	$filename=$argv[1];
	$metric=$argv[2];
	
 $opts_d = array( "--start", "-1d", "--vertical-label=bytes per second",
		         "DEF:bps1=$filename.rrd:$metric:AVERAGE",
		
		         "LINE1:bps1#FF0000:In traffic\\r",
			 
			 "--dynamic-labels",
			 "--title=One day graph",
	  		 "--color=BACK#CCCCCC",      
		    	 "--color=CANVAS#CCFFFF",    
		    	 "--color=SHADEB#9999CC",
		         "COMMENT:\\n",
		         "GPRINT:bps1:LAST:Last In \: %6.2lf %SBps",
		         "COMMENT:  ", 
			
			 "GPRINT:bps1:MAX:Maximum In \: %6.2lf %SBps",
		         "COMMENT:  ",
			 
			 "GPRINT:bps1:MIN:Minimum In \: %6.2lf %SBps",
			 "COMMENT:  ",
			 
			 "GPRINT:bps1:AVERAGE:Average In \: %6.2lf %SBps",
		         "COMMENT:  ",                  
		         
		       );

	  $ret_d = rrd_graph("day.png", $opts_d);

 $opts_w = array( "--start", "-1w", "--vertical-label=bytes per second",
		         "DEF:bps1=$filename.rrd:$metric:AVERAGE",
		
		         "LINE1:bps1#FF0000:In traffic\\r",
			 
			 "--dynamic-labels",
			 "--title=Week graph",
	  		 "--color=BACK#CCCCCC",      
		    	 "--color=CANVAS#CCFFFF",    
		    	 "--color=SHADEB#9999CC",
		         "COMMENT:\\n",
		         "GPRINT:bps1:LAST:Last In \: %6.2lf %SBps",
		         "COMMENT:  ", 
			
			 "GPRINT:bps1:MAX:Maximum In \: %6.2lf %SBps",
		         "COMMENT:  ",
			 
			 "GPRINT:bps1:MIN:Minimum In \: %6.2lf %SBps",
			 "COMMENT:  ",
			 
			 "GPRINT:bps1:AVERAGE:Average In \: %6.2lf %SBps",
		         "COMMENT:  ",                  
		         
		       );

	  $ret_w = rrd_graph("week.png", $opts_w); 
	  
	  
	  
	  $opts_m = array( "--start", "-1m", "--vertical-label=bytes per second",
		         "DEF:bps1=$filename.rrd:$metric:AVERAGE",
		
		         "LINE1:bps1#FF0000:In traffic\\r",
			 
			 "--dynamic-labels",
			 "--title=monthly graph",
	  		 "--color=BACK#CCCCCC",      
		    	 "--color=CANVAS#CCFFFF",    
		    	 "--color=SHADEB#9999CC",
		         "COMMENT:\\n",
		         "GPRINT:bps1:LAST:Last In \: %6.2lf %SBps",
		         "COMMENT:  ", 
			
			 "GPRINT:bps1:MAX:Maximum In \: %6.2lf %SBps",
		         "COMMENT:  ",
			 
			 "GPRINT:bps1:MIN:Minimum In \: %6.2lf %SBps",
			 "COMMENT:  ",
			 
			 "GPRINT:bps1:AVERAGE:Average In \: %6.2lf %SBps",
		         "COMMENT:  ",                  
		         
		       );

	  $ret_m = rrd_graph("month.png", $opts_m); 
	  
	  $opts_y = array( "--start", "-1y", "--vertical-label=bytes per second",
		         "DEF:bps1=$filename.rrd:$metric:AVERAGE",
		
		         "LINE1:bps1#FF0000:In traffic\\r",
			 
			 "--dynamic-labels",
			 "--title=yearly  graph",
	  		 "--color=BACK#CCCCCC",      
		    	 "--color=CANVAS#CCFFFF",    
		    	 "--color=SHADEB#9999CC",
		         "COMMENT:\\n",
		         "GPRINT:bps1:LAST:Last In \: %6.2lf %SBps",
		         "COMMENT:  ", 
			
			 "GPRINT:bps1:MAX:Maximum In \: %6.2lf %SBps",
		         "COMMENT:  ",
			 
			 "GPRINT:bps1:MIN:Minimum In \: %6.2lf %SBps",
			 "COMMENT:  ",
			 
			 "GPRINT:bps1:AVERAGE:Average In \: %6.2lf %SBps",
		         "COMMENT:  ",                  
		         
		       );

	  $ret_y = rrd_graph("year.png", $opts_y);


?>


