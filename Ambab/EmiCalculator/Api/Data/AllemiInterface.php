<?php
namespace Ambab\EmiCalculator\Api\Data;

interface AllemiInterface {
    const EMI_ID = 'emi_id';
    const BANK_CODE = 'bank_code';
    const MONTH = 'month';
    const INTEREST = 'interest';
    const STATUS = 'status';
    const CREATED_AT = 'created_at';
	const UPDATED_AT = 'updated_at';

    public function getEmiId();
    public function getBankCode();
    public function getMonth();
    public function getInterest();
    public function getStatus();
    public function getCreatedAt();
    public function getUpdatedAt();

    public function setEmiId($id);
    public function setBankCode($bankCode);
    public function setMonth($month);
    public function setInterest($interest);
    public function setStatus($status);
    public function setCreatedAt($createdAt);
    public function setUpdatedAt($updatedAt);
}