<?php
/*
 * Licensed to the Apache Software Foundation (ASF) under one
 * or more contributor license agreements.  See the NOTICE file
 * distributed with this work for additional information
 * regarding copyright ownership.  The ASF licenses this file
 * to you under the Apache License, Version 2.0 (the
 * "License"); you may not use this file except in compliance
 * with the License.  You may obtain a copy of the License at
 *
 *     http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing,
 * software distributed under the License is distributed on an
 * "AS IS" BASIS, WITHOUT WARRANTIES OR CONDITIONS OF ANY
 * KIND, either express or implied.  See the License for the
 * specific language governing permissions and limitations
 * under the License.
 */
namespace Market\Request\V20151101;

class ActivateLicenseRequest extends \RpcAcsRequest
{
	function  __construct()
	{
		parent::__construct("Market", "2015-11-01", "ActivateLicense");
	}

	private  $licenseCode;

	private  $identification;

	public function getLicenseCode() {
		return $this->licenseCode;
	}

	public function setLicenseCode($licenseCode) {
		$this->licenseCode = $licenseCode;
		$this->queryParameters["LicenseCode"]=$licenseCode;
	}

	public function getIdentification() {
		return $this->identification;
	}

	public function setIdentification($identification) {
		$this->identification = $identification;
		$this->queryParameters["Identification"]=$identification;
	}
	
}