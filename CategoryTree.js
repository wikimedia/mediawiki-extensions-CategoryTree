/*
 * JavaSCript functions for the CategoryTree extension, an AJAX based gadget 
 * to display the category structure of a wiki
 *
 * @package MediaWiki
 * @subpackage Extensions
 * @author Daniel Kinzler <duesentrieb@brightbyte.de>
 * @copyright © 2006 Daniel Kinzler
 * @licence GNU General Public Licence 2.0 or later
*/
    
    function categoryTreeNextDiv(e) {
      n= e.nextSibling;
      while ( n && ( n.nodeType != 1 || n.nodeName != 'DIV') ) {
          //alert('nodeType: ' + n.nodeType + '; nodeName: ' + n.nodeName);
          n= n.nextSibling;
      }
      
      return n;
    }
    
    function categoryTreeExpandNode(cat, mode, lnk) {
      var div= categoryTreeNextDiv( lnk.parentNode.parentNode );
      
      div.style.display= 'block';
      lnk.innerHTML= '&ndash;';
      lnk.title= categoryTreeCollapseMsg;
      lnk.onclick= function() { categoryTreeCollapseNode(cat, mode, lnk) }
        
      if (lnk.className != "CategoryTreeLoaded") {
        categoryTreeLoadNode(cat, mode, lnk, div);
      }
    }
    
    function categoryTreeCollapseNode(cat, mode, lnk) {
      var div= categoryTreeNextDiv( lnk.parentNode.parentNode );
      
      div.style.display= 'none';
      lnk.innerHTML= '+';
      lnk.title= categoryTreeExpandMsg;
      lnk.onclick= function() { categoryTreeExpandNode(cat, mode, lnk) }
    }
    
    function categoryTreeLoadNode(cat, mode, lnk, div) {
      var page_request = false;
      
      div.innerHTML= '<i class="CategoryTreeNotice">' + categoryTreeLoadingMsg + '</i>';
      div.style.display= 'block';
      lnk.className= 'CategoryTreeLoaded';
      lnk.innerHTML= '&ndash;';
      lnk.title= categoryTreeCollapseMsg;
      lnk.onclick= function() { categoryTreeCollapseNode(cat, mode, lnk) }
          
      function f( result ) {
          if ( result == '' ) result= '<i class="CategorTreeNotice">' + categoryTreeNothingFoundMsg + '</i>';
          div.innerHTML= result;
      }
      
      categoryTreeDoCall( cat, mode, f );
    }
    
    function categoryTreeDoCall() {
      sajax_do_call( "efCategoryTreeAjaxWrapper", categoryTreeDoCall.arguments );
    }
