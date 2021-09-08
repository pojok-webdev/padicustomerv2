$.fn.dataTableExt.afnFiltering.push(
    function( oSettings, aData, iDataIndex ) {
        var iMin = document.getElementById('min').value * 1;
        var iMax = document.getElementById('max').value * 1;
        var iVersion = aData[3] == "-" ? 0 : aData[3]*1;
        if ( iMin == "" && iMax == "" )
        {
            return true;
        }
        else if ( iMin == "" && iVersion < iMax )
        {
            return true;
        }
        else if ( iMin < iVersion && "" == iMax )
        {
            return true;
        }
        else if ( iMin < iVersion && iVersion < iMax )
        {
            return true;
        }
        return false;
    }
);