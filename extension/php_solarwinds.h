/* solarwinds extension for PHP */

#ifndef PHP_SOLARWINDS_H
# define PHP_SOLARWINDS_H

extern zend_module_entry solarwinds_module_entry;
# define phpext_solarwinds_ptr &solarwinds_module_entry

# define PHP_SOLARWINDS_VERSION "0.0.1"

# if defined(ZTS) && defined(COMPILE_DL_SOLARWINDS)
ZEND_TSRMLS_CACHE_EXTERN()
# endif

#endif	/* PHP_SOLARWINDS_H */
