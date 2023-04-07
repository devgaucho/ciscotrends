<?php
function picoDeMemoria(){
	return tamanhoBonito(memory_get_peak_usage(),false);
}