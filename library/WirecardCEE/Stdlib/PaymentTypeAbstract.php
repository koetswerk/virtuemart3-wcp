<?php
/*
* Die vorliegende Software ist Eigentum von Wirecard CEE und daher vertraulich
* zu behandeln. Jegliche Weitergabe an dritte, in welcher Form auch immer, ist
* unzulaessig.
*
* Software & Service Copyright (C) by
* Wirecard Central Eastern Europe GmbH,
* FB-Nr: FN 195599 x, http://www.wirecard.at
*/

/**
 * @name WirecardCEE_Stdlib_PaymentTypeAbstract
 * @category WirecardCEE
 * @package WirecardCEE_Stdlib
 * @version 3.2.0
 * @abstract
 */
abstract class WirecardCEE_Stdlib_PaymentTypeAbstract
{
    const BMC = 'BANCONTACT_MISTERCASH';
    const CCARD = 'CCARD';
    const CCARD_MOTO = 'CCARD-MOTO';
    const EKONTO = 'EKONTO';
    const EPAYBG = 'EPAY_BG';
    const EPS = 'EPS';
    const GIROPAY = 'GIROPAY';
    const IDL = 'IDL';
    const INSTALLMENT = 'INSTALLMENT';
    const INVOICE = 'INVOICE';
    const MAESTRO = 'MAESTRO';
    const MONETA = 'MONETA';
    const MPASS = 'MPASS';
    const P24 = 'PRZELEWY24';
    const PAYPAL = 'PAYPAL';
    const PBX = 'PBX';
    const POLI = 'POLI';
    const PSC = 'PSC';
    const QUICK = 'QUICK';
    const SEPADD = 'SEPA-DD';
    const ELV = 'ELV';
    const SKRILLDIRECT = 'SKRILLDIRECT';
    const SKRILLWALLET = 'SKRILLWALLET';
    const SOFORTUEBERWEISUNG = 'SOFORTUEBERWEISUNG';
    const TATRAPAY = 'TATRAPAY';
    const TRUSTLY = 'TRUSTLY';
    const TRUSTPAY = 'TRUSTPAY';
    const VOUCHER = 'VOUCHER';

    /**
     * array of eps financial institutions
     * keep this sort order
     *
     * @var string[]
     *
     * @todo would be nice to get this values directly from the server so the data is in sync
     */
    protected static $_eps_financial_institutions = Array(
        'ARZ|AAB'       => 'Austrian Anadi Bank AG',
        'BA-CA'         => 'Bank Austria',
        'BB-Racon'      => 'Bank Burgenland',
        'ARZ|BD'        => 'bankdirekt.at AG',
        'ARZ|BAF'       => 'Bank für &Auml;rzte und Freie Berufe ',
        'ARZ|BCS'       => 'Bankhaus Carl Sp&auml;ngler &amp; Co. AG',
        'ARZ|BSS'       => 'Bankhaus Schelhammer &amp; Schattera AG',
        'Bawag|B'       => 'BAWAG',
        'ARZ|BKS'       => 'BKS Bank AG',
        'ARZ|BTV'       => 'BTV VIER L&Auml;NDER BANK',
        'ARZ|VB'        => 'Die &ouml;sterreichischen Volksbanken',
        'Bawag|E'       => 'easybank',
        'Spardat|EBS'   => 'Erste Bank und Sparkassen',
        'ARZ|GB'        => 'G&auml;rtnerbank',
        'ARZ|HAA'       => 'Hypo Alpe-Adria-Bank International AG',
        'ARZ|HI'        => 'Hypo Investmentbank AG',
        'Hypo-Racon|O'  => 'Hypo Ober&ouml;sterreich',
        'Hypo-Racon|S'  => 'Hypo Salzburg',
        'Hypo-Racon|St' => 'Hypo Steiermark',
        'ARZ|HTB'       => 'Hypo Tirol Bank AG',
        'ARZ|IB'        => 'Immo-Bank',
        'ARZ|IKB'       => 'Investkredit Bank AG',
        'ARZ|NLH'       => 'Nieder&ouml;sterreichische Landes-Hypothekenbank AG',
        'ARZ|OB'        => 'Oberbank AG',
        'ARZ|AB'        => '&Ouml;sterreichische Apothekerbank',
        'ARZ|PB'        => 'PRIVAT BANK AG',
        'Bawag|P'       => 'PSK Bank',
        'Racon'         => 'Raiffeisen Bank',
        'Bawag|S'       => 'Sparda Bank',
        'ARZ|SBL'       => 'Sparda-Bank Linz',
        'ARZ|SBVI'      => 'Sparda-Bank Villach/Innsbruck',
        'ARZ|VLH'       => 'Vorarlberger Landes- und Hypothekerbank AG',
        'ARZ|SB'        => 'Schoellerbank AG',
        'ARZ|VKB'       => 'Volkskreditbank AG',
        'ARZ|VRB'       => 'VR-Bank Braunau'
    );

    /**
     * array of iDEAL financial institutions
     *
     * @var string[]
     *
     * @todo would be nice to get this values directly from the server so the data is in sync
     */
    protected static $_idl_financial_institutions = Array(
        'ABNAMROBANK'   => 'ABN AMRO Bank',
        'ASNBANK'       => 'ASN Bank',
        'INGBANK'       => 'ING',
        'KNAB'          => 'Knab',
        'RABOBANK'      => 'Rabobank',
        'SNSBANK'       => 'SNS Bank',
        'REGIOBANK'     => 'Regio Bank',
        'TRIODOSBANK'   => 'Triodos Bank',
        'VANLANSCHOT'   => 'Van Lanschot Bankiers'
    );


    /**
     * check if the given paymenttype has financial institions
     *
     * @param string $paymentType
     *
     * @return bool
     */
    public static function hasFinancialInstitutions($paymentType)
    {
        return (bool) ( $paymentType == self::EPS || $paymentType == self::IDL );
    }

    /**
     * the an array of financial institutions for the given paymenttype.
     *
     * @param string $paymentType
     *
     * @return string[]
     */
    public static function getFinancialInstitutions($paymentType)
    {
        switch ($paymentType) {
            case self::EPS:
                return self::$_eps_financial_institutions;
                break;
            case self::IDL:
                return self::$_idl_financial_institutions;
                break;
            default:
                return Array();
                break;
        }
    }

    /**
     * Returns full name of the financial institution
     * Used in dd_wirecard_order.php (function: getPayment())
     *
     * @param string $sFinancialInstitutionShortCode
     *
     * @return string
     */
    public static function getFinancialInstitutionFullName($sFinancialInstitutionShortCode)
    {
        if (array_key_exists($sFinancialInstitutionShortCode, self::$_eps_financial_institutions)) {
            return self::$_eps_financial_institutions[$sFinancialInstitutionShortCode];
        }

        if (array_key_exists($sFinancialInstitutionShortCode, self::$_idl_financial_institutions)) {
            return self::$_idl_financial_institutions[$sFinancialInstitutionShortCode];
        }

        return "";
    }
}
