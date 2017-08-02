<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace Magento\Sales\Api\Data;

/**
 * Transaction interface.
 *
 * A transaction is an interaction between a merchant and a customer such as a purchase, a credit, a refund, and so on.
 * @api
 * @since 2.0.0
 */
interface TransactionInterface extends \Magento\Framework\Api\ExtensibleDataInterface
{
    /**#@+
     * Supported transaction types
     * @var string
     */
    const TYPE_PAYMENT = 'payment';

    const TYPE_ORDER = 'order';

    const TYPE_AUTH = 'authorization';

    const TYPE_CAPTURE = 'capture';

    const TYPE_VOID = 'void';

    const TYPE_REFUND = 'refund';

    /**#@-*/

    /**#@+
     * Constants for keys of data array. Identical to the name of the getter in snake case.
     */
    /*
     * Transaction ID.
     */
    const TRANSACTION_ID = 'transaction_id';
    /*
     * Parent ID.
     */
    const PARENT_ID = 'parent_id';
    /*
     * Order ID.
     */
    const ORDER_ID = 'order_id';
    /*
     * Payment ID.
     */
    const PAYMENT_ID = 'payment_id';
    /*
     * Transaction business ID.
     */
    const TXN_ID = 'txn_id';
    /*
     * Parent transaction ID.
     */
    const PARENT_TXN_ID = 'parent_txn_id';
    /*
     * Transaction type.
     */
    const TXN_TYPE = 'txn_type';
    /*
     * Is closed flag.
     */
    const IS_CLOSED = 'is_closed';
    /*
     * Additional information.
     */
    const ADDITIONAL_INFORMATION = 'additional_information';
    /*
     * Created-at timestamp.
     */
    const CREATED_AT = 'created_at';
    /*
     * Method.
     */
    const METHOD = 'method';
    /*
     * Increment ID.
     */
    const INCREMENT_ID = 'increment_id';
    /*
     * Child transactions.
     */
    const CHILD_TRANSACTIONS = 'child_transactions';

    /**
     * Gets the transaction ID for the transaction.
     *
     * @return int Transaction ID.
     * @since 2.0.0
     */
    public function getTransactionId();

    /**
     * Sets the transaction ID for the transaction.
     *
     * @param int $id
     * @return $this
     * @since 2.0.0
     */
    public function setTransactionId($id);

    /**
     * Gets the parent ID for the transaction.
     *
     * @return int|null The parent ID for the transaction. Otherwise, null.
     * @since 2.0.0
     */
    public function getParentId();

    /**
     * Gets the order ID for the transaction.
     *
     * @return int Order ID.
     * @since 2.0.0
     */
    public function getOrderId();

    /**
     * Gets the payment ID for the transaction.
     *
     * @return int Payment ID.
     * @since 2.0.0
     */
    public function getPaymentId();

    /**
     * Gets the transaction business ID for the transaction.
     *
     * @return string Transaction business ID.
     * @since 2.0.0
     */
    public function getTxnId();

    /**
     * Gets the parent transaction business ID for the transaction.
     *
     * @return string Parent transaction business ID.
     * @since 2.0.0
     */
    public function getParentTxnId();

    /**
     * Gets the transaction type for the transaction.
     *
     * @return string Transaction type.
     * @since 2.0.0
     */
    public function getTxnType();

    /**
     * Gets the value of the is-closed flag for the transaction.
     *
     * @return int Is-closed flag value.
     * @since 2.0.0
     */
    public function getIsClosed();

    /**
     * Gets any additional information for the transaction.
     *
     * @return string[]|null Array of additional information. Otherwise, null.
     * @since 2.0.0
     */
    public function getAdditionalInformation();

    /**
     * Gets the created-at timestamp for the transaction.
     *
     * @return string Created-at timestamp.
     * @since 2.0.0
     */
    public function getCreatedAt();

    /**
     * Sets the created-at timestamp for the transaction.
     *
     * @param string $createdAt timestamp
     * @return $this
     * @since 2.0.0
     */
    public function setCreatedAt($createdAt);

    /**
     * Gets an array of child transactions for the transaction.
     *
     * @return \Magento\Sales\Api\Data\TransactionInterface[] Array of child transactions.
     * @since 2.0.0
     */
    public function getChildTransactions();

    /**
     * Sets the parent ID for the transaction.
     *
     * @param int $id
     * @return $this
     * @since 2.0.0
     */
    public function setParentId($id);

    /**
     * Sets the order ID for the transaction.
     *
     * @param int $id
     * @return $this
     * @since 2.0.0
     */
    public function setOrderId($id);

    /**
     * Sets the payment ID for the transaction.
     *
     * @param int $id
     * @return $this
     * @since 2.0.0
     */
    public function setPaymentId($id);

    /**
     * Sets the transaction business ID for the transaction.
     *
     * @param string $id
     * @return $this
     * @since 2.0.0
     */
    public function setTxnId($id);

    /**
     * Sets the parent transaction business ID for the transaction.
     *
     * @param string $id
     * @return $this
     * @since 2.0.0
     */
    public function setParentTxnId($id);

    /**
     * Sets the transaction type for the transaction.
     *
     * @param string $txnType
     * @return $this
     * @since 2.0.0
     */
    public function setTxnType($txnType);

    /**
     * Sets the value of the is-closed flag for the transaction.
     *
     * @param int $isClosed
     * @return $this
     * @since 2.0.0
     */
    public function setIsClosed($isClosed);

    /**
     * Additional information setter
     * Updates data inside the 'additional_information' array
     * Does not allow setting of arrays
     *
     * @param string $key
     * @param mixed $value
     * @return $this
     * @throws \Magento\Framework\Exception\LocalizedException
     * @since 2.0.0
     */
    public function setAdditionalInformation($key, $value);

    /**
     * Retrieve existing extension attributes object or create a new one.
     *
     * @return \Magento\Sales\Api\Data\TransactionExtensionInterface|null
     * @since 2.0.0
     */
    public function getExtensionAttributes();

    /**
     * Set an extension attributes object.
     *
     * @param \Magento\Sales\Api\Data\TransactionExtensionInterface $extensionAttributes
     * @return $this
     * @since 2.0.0
     */
    public function setExtensionAttributes(\Magento\Sales\Api\Data\TransactionExtensionInterface $extensionAttributes);
}
