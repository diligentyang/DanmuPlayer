﻿using System.Web;
using System.Web.Optimization;

namespace DanmuPlayer
{
    public class BundleConfig
    {
        // 有关绑定的详细信息，请访问 http://go.microsoft.com/fwlink/?LinkId=301862
        public static void RegisterBundles(BundleCollection bundles)
        {
            bundles.Add(new ScriptBundle("~/bundles/jquery").Include(
                        "~/Scripts/jquery-{version}.js",
                        "~/Scripts/nprogress.js"));

            bundles.Add(new ScriptBundle("~/bundles/jqueryval").Include(
                        "~/Scripts/jquery.validate*"));

            // 使用要用于开发和学习的 Modernizr 的开发版本。然后，当你做好
            // 生产准备时，请使用 http://modernizr.com 上的生成工具来仅选择所需的测试。
            bundles.Add(new ScriptBundle("~/bundles/modernizr").Include(
                        "~/Scripts/modernizr-*"));

            bundles.Add(new ScriptBundle("~/bundles/bootstrap").Include(
                      "~/Scripts/bootstrap.js",
                      "~/Scripts/respond.js"));

            bundles.Add(new ScriptBundle("~/bundles/danmuplayer").Include(
                      "~/Scripts/jquery-2.1.4.min.js",
                      "~/Scripts/jquery.shCircleLoader.js",
                      "~/Scripts/sco.tooltip.js",
                      "~/Scripts/colpick.js",
                      "~/Scripts/jquery.danmu.js",
                      "~/Scripts/jquery.share.min.js",
                      "~/Scripts//main.js"));

            bundles.Add(new StyleBundle("~/Content/css").Include(
                      "~/Content/former.css",
                      "~/Content/scojs.css",
                      "~/Content/colpick.css",
                      "~/Content/bootstrap.css",
                      "~/Content/main.css",
                      "~/Content/site.css",
                      "~/Content/share.min.css",
                      "~/Content/nprogress.css"));
        }
    }
}
