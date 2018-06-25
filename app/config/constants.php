<?php
/**
 * Couponator
 *
 * PHP version 5
 *
 * @category   PHP
 * @package    couponator
 * @subpackage Core
 * @author     Agriya <info@agriya.com>
 * @copyright  2018 Agriya Infoway Private Ltd
 * @license    http://www.agriya.com/ Agriya Infoway Licence
 * @link       http://www.agriya.com
 */
class ConstUserTypes
{
    const Admin = 1;
    const User = 2;
}
class ConstUser
{
    const Admin = 1;
}
class ConstCouponTypes
{
    const CouponCodes = 2;
    const ShoppingTips = 1;
    const Printables = 3;
    const FreeShipping =4;
}
class ConstAffiliateSites
{
    const Site = 1;
    const LinkShare = 2;
    const CommunityJunction = 3;
    const Pepperjam = 4;
	const Shareasale = 5;
	const Formetocoupon = 6;
	const ConnectCommerce = 7;
}
class ConstCouponDisplayTypes
{
    const ClickToCopy = 'Click to copy';
    const ClickToReveal = 'Click to reveal';
    const LinkToShow = 'Link to show';
}
class ConstStatuses
{
    const Upcoming = 1;
    const Live = 2;
    const Expired = 3;
    const Active = 4;
}
class ConstAttachment
{
    const UserAvatar = 1;
    const Store = 2;
}
class ConstMoreAdsPositionCoupon
{
    const Top = 1;
    const Bottom = 2;
    const Mixed = 3;
}
class ConstStoreStatus
{
    const NewStore = 1;
    const ActiveStore = 2;
    const RejectedStore = 3;
	const Partner = 4;
}
class ConstStoreUpdate
{
    const Manual = 1;
    const Auto = 2;
}
class ConstCouponTypeStatus
{
    const SpecialOffer = 1;
    const Unreliable = 2;
    const Normalcoupon = 3;
}
class ConstCouponStatus
{
    const CheckStore = 1;
    const NewCoupon = 2;
    const RejectedStore = 3;
    const ActiveCoupon = 4;
    const RejectedCoupon = 5;
    const OutdatedCoupon = 6;
	const Partner = 7;
}

class ConstRatingType
{
    const Up = 1;
    const Down = 2;
}
class ConstMoreAction
{
    const Inactive = 1;
    const Active = 2;
    const Delete = 3;
    const OpenID = 4;
    const Export = 5;
    const Approved = 6;
    const Disapproved = 7;
    const Featured = 8;
    const Notfeatured = 9;
    const Twitter = 22;
    const Facebook = 23;
    const Gmail = 39;
    const Yahoo = 40;
    const Normal = 38;
    const Checked = 28;
    const Unchecked = 29;
    const UnSubscribe = 30;
    const Suspend = 31;
    const Unsuspend = 32;
	const NewStore = 33;
	const ActiveStore = 34;
	const RejectedStore = 35;
	const Partner = 36;
}
class ConstMoreActionCoupon
{
    const Inactive = 1;
    const Active = 2;
    const Delete = 11;
    const Home = 4;
    const Top = 5;
    const Popular = 6;
    const Online = 10;
    const Offline = 7;
    const Featured = 8;
    const Notfeatured = 9;
    const Approved = 10;
    const ActiveStatus = 12;
    const Specialoffer = 21;
    const Unreliable = 22;
    const Activecoupon = 23;
    const CouponCode = 24;
    const Shoppingtip = 25;
    const Printables = 26;
    const Freeshipping = 27;
	const CheckStore = 28;
	const NewCoupon = 29;
	const RejectedStore = 30;
	const ActivesCoupon = 31;
	const RejectedCoupon = 32;
	const OutdatedCoupon = 33;
	const Partner = 34;
}
// Banned ips types
class ConstBannedTypes
{
    const SingleIPOrHostName = 1;
    const IPRange = 2;
    const RefererBlock = 3;
}
// Banned ips durations
class ConstBannedDurations
{
    const Permanent = 1;
    const Days = 2;
    const Weeks = 3;
}
class ConstCouponFeedback
{
    const Worked = 1;
    const NotWorked = 2;
}