//SPDX-License-Identifier: MIT
pragma solidity >= 0.7.0 <0.9.0;

contract Hello{

    uint Data; //state variable
    string public hi="Hello solidity";

    function bid()public payable{
        //
    }
}

function helper(uint x)pure returns(uint){
    return x*2;
}